import networkx, collections, re, sqlalchemy, operator, random
import matplotlib.pyplot as plt
from datetime import datetime

#TURN OFF LOCATIONS (AS AN OPTION!!)

engine = sqlalchemy.create_engine('mysql://g7y2012:Cagyov@ephesus.cs.cf.ac.uk/g7y2012db')
connection = engine.connect()
cosmos = engine.execute("select * from cosmos")
places  = engine.execute("select * from places")

def mrt():
    tweets = []
    data = collections.defaultdict(int) #SPEED - https://gist.github.com/dpifke/2244911
    #add items to list that contain the letters 'RT'
    for row in cosmos:
    	if 'RT' in row['tweet_text']:
    		tweets.append(row['tweet_text'])
    #Iterate over the list, counting the number of occurences
    #increment by one for each tweet.
    for tweet in tweets:
    	data[tweet] += 1
    #return the tweet (key) that contains the maximum value
    return max(data, key=data.get)

def __datetime(date_str):
    return datetime.strptime(date_str, '%Y-%m-%d %H:%M:%S')

db = engine.execute("select * from cosmos")

def graph_mrt():
    mostrt = mrt()
    lst = []
    graph = networkx.Graph()
    
    for row in db:
    	if mostrt in row['tweet_text']:
            lst.append([datetime.fromtimestamp(int(row['timestamp'])).strftime('%Y-%m-%d %H:%M:%S'), row['location']])
    origin = __datetime(lst[0][0])#first item in list
    
    for row in lst:
        nextdt = __datetime(row[0])#every other item in list per iteration    
        print nextdt
        edge   = nextdt - origin
        graph.add_edge(origin, edge, len=edge)

    #print [i for i in graph.nodes()]
    networkx.draw(graph) #let's graph it!
    plt.savefig( "" + str(random.randrange(1000)) + ".png")
    return (None)

print graph_mrt()


#Could be usefull... takes any amount of paramets (say multiple hashtags)
# and then do something with them (say, pass them to another function?)
#def hashTags(*params):

#    result = []
#    hashtags = [i for i in params]

#    for row in database:
#        for word in hashtags:
#            if 'RT' and word in row['tweet_text']:
#            	print row['tweet_text']
#            	result.append(row['tweet_text'])
#    print row['tweet_text']

#Finds the most re-tweeted tweet - use as origin
#since the origin cannot be determined... perhaps write an elseif, incase it can?


#def getNameRT():
#    return re.search(r'@([A-Za-z0-0_]+)', mostRT()).group()

#returns all relevant data related to the most re-tweeted tweet, such as time...
def origin():
    
    mostrt = mrt()
    lst = []
    
    #try to determine the origin of the most tweeted re-tweet
    #since the dataset may not contain the original tweet, then
    #the most re-tweeted tweet would be substituted...
    
    for row in db:
        #if the username
        if username in row['tweet_text']:
        	print row['tweet_text']
        else:
        	return mostrt
    return ''
