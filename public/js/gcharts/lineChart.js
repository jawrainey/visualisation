function lineChart(daten, width, height, div)
{
    google.setOnLoadCallback( function()
    {
        var data = new google.visualization.DataTable();
        //Currently, these columns are hard-coded, thus making the
        //solution static and limited to only two columns...
        data.addColumn('string');
        data.addColumn('number');
        //An array to hold the daten objects when they're converted to arrays
        var rowData = [];
        //Convert the objects into arrays using underscore.js
        for (var item in daten)
        {
            rowData.push(_.toArray(daten[item]));
        }
        //now we have the arrays, let's visualise them with the Google API.
        for (item in rowData)
        {
            data.addRow([rowData[item][1], parseInt(rowData[item][0])]);
        }
        //Initalise the chart, and draw it with our data, to the specified element.
        new google.visualization.LineChart(document.getElementById(div)).draw(data, {"width": width, "height": height});
    });

}
