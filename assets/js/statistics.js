/// STATISTICS
  $(document).ready(function(){
  var d1 = [];
  var tickBirth = [];
  var dataBirth =[];
  var tickSB =[];
      $.ajax({
          url:"statistics_data.php",
          type: "post",
          data :{tableBirth:"sbirth",tableDeath: "sdeadtable"},
          dataType : "json",
          success:function(res)
          {
            for(var i=0;i<res.length;i++)
            {
              var year = res[i][0];
              var row_number = res[i][1];
                d1.push([i,row_number]);
                tickBirth.push([i,year]);
            }
            dataBirth = d1;
            tickSB = tickBirth;

            console.log(tickSB);
            var options = {
            	series: {
            		shadowSize: 0,
            		lines: {
            			show: true,
            		},
            	},
            	grid: {
            		borderWidth: 1,
            		labelMargin:10,
            		mouseActiveRadius:6,
            		borderColor: '#eee',
            		show : true,
            		hoverable : true,
            		clickable : true

            	},
            	xaxis: {
            		tickColor: '#fff',
            		tickDecimals: 0,
            		font :{
            			lineHeight: 13,
            			style: "normal",
            			color: "#9f9f9f"
            		},
            		shadowSize: 0,
            		ticks: tickSB
            	},

              yaxis: {
            		tickColor: '#eee',
            		tickDecimals: 0,
            		font :{
            			lineHeight: 13,
            			style: "normal",
            			color: "#9f9f9f",
            		},
            		shadowSize: 0
            	},

            	legend: {
            		container: '.flc-line',
            		backgroundOpacity: 0.5,
            		noColumns: 0,
            		backgroundColor: "white",
            		lineWidth: 0
            	},
            	colors: ["#6baa01", "#33bdda", "#008ee4"]
            };

            $.plot($("#m_line_chart"), [
            	{data: dataBirth, lines: { show: true  }, label: 'Product A', stack: true, color: '#F9D900' },


            ], options);
          }
      });
  });

//var d1 = [[0,30],[1,1000],[2,65],[3,30],[4,30],[5,35],[6,32],[7,37],[8,30],[9,35],[10,30],[11,31]];
var d2 = [[0,50],[1,40],[2,45],[3,60],[4,50],[5,50],[6,60],[7,55],[8,50],[9,50],[10,60],[11,35]];
//var d3 = [[0,40],[1,10],[2,35],[3,25],[4,40],[5,45],[6,55],[7,50],[8,35],[9,40],[10,48],[11,40]];



// Create a regular Line Chart
