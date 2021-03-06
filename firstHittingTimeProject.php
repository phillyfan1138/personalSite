<!DOCTYPE html>
<html>
    <head>
        <meta name="contentType" content="projects">
        <meta name="keywords" content="firstHitting">
        <meta name="description" content="Density of First Hitting Time">
        <?php include 'assets/includes/header.php';?>
        
   <!-- <style>
        .list-group { 
            max-height: 500px;
            overflow:auto;
        }
        .input-group-addon {
	        min-width:160px;
	        text-align:left;
	    }
    </style> -->
    </head>
    <body>
        
		
		<div class='navbar-fixed-top'>
            <div class="container title lead">
               <h1>Compute the Density of the First Hitting Time</h1>
            </div>
        </div>
        <div class="container">
            <div class='row txt'>
                This application computes the density of the first hitting time of a CEV process.  See <?php include 'assets/includes/scrapeSimilar.php'; ?> for an explanation for the mathematics behind this application.
            </div>
			<div class='row'>
				<div class='col-md-4'>
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">Value To Hit</span>
						<input id="m" type="text" name="" class="form-control required" placeholder="5">
					</div>
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">alpha</span> 
						<input id="alpha"  type="text" name="" class="form-control required" placeholder=".1">
					</div> 
					
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">sigma</span>
						<input id="sigma" type="text" name="" class="form-control required" placeholder=".3">
					</div>
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">delta</span> 
						<input id="delta" type="text" name="" class="form-control required" placeholder=".8">
					</div> 
					
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">Discrete steps in "u"</span>
						<input id="n" type="text" name="" class="form-control required" placeholder="256">
					</div>
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">Discrete steps in "t"</span> 
						<input id="k" type="text" name="" class="form-control required" placeholder="512">
					</div> 
					<div class="input-group"><span class="input-group" id="">
						<span class="input-group-addon" id="">Discrete steps in "x"</span> 
						<input id="l" type="text" name="" class="form-control required" placeholder="300">
					</div>
					<input id='submitButton' type="submit" class="btn btn-primary"></input>
				</div>
				
				<div class='col-md-6'>
					
					<div id="chart">
					</div>
					<div class="progress">
						<div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
					</div>
				</div>
                <div class='col-md-2'> 
                    
                    <div class="dropdown push-right"> 
                        
                        <!--<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    Select X-Values
                        <span class="caret"></span>
                        </button>-->
                    </div>
                
                </div>
			</div>
			
			
		</div>
        <?php include 'assets/includes/menu.php';?> <!--side menu -->
    </body>
    <?php include 'assets/includes/footerScripts.php';?> <!--final includes for side menu -->
    <script>
        $('.progress').hide();//('hidden');
        $('.dropdown').hide();//('hidden');
        var myChart="";
        var xAxis;
        var yAxis;
        var data={};
        var attributes={};
        
      
        $('#submitButton').click(function(e){
            //attributes=[];
            $('#chart').empty();
            $('.dropdown').hide();
            $('#progressBar').css("width", "0%");
            var allFilledIn=true;
            var options={};
            getValues();
           /* $('.required').each(function(val){
                var values=$(this).val();
                if(!values){
                    allFilledIn=false;
                }
                options[$(this).attr('id')]=Number(values); 
        
            });*/
            if(!allFilledIn){
                alert("requires all to be filled in!");
                return false;
            }
           // $(".progress" ).progressbar( "option", "max",  options['n']+options['l'] ); 
           
            //var data=FangOosterlee(n, k, l, m, alpha, delta, sigma, m*.2, $('.progress-bar')); //hopefully m*.2 is a good number..
            var worker = new Worker('js/ode.js');
			worker.postMessage({'options': 
				attributes
			});
             $('.progress').show();//('hidden');
            //data=FangOosterlee(options, $("#progress")); //hopefully m*.2 is a good number..
            worker.onmessage = function (event) {
            	//console.log(event);
            	if(event.data.update){
            		//console.log("got here1");
            		//console.log(event.data.update);
					$('#progressBar').css("width", event.data.update);
				}
				else { 
					 data=event.data.result;
					 var keys=Object.keys(data);
					//keys=keys.sort();
					keys.sort();
					var n=keys.length;
					/*var domString="<ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>";
					for(var i=0; i<n; i++){
						domString=domString+"<li role='presentation'><a class='selectSeries' role='menuitem' tabindex='-1' href='#'>"+keys[i]+"</a></li>";
				
					 }*/
                    var domString="<span class='input-group-addon' >X-Values</span><div class='list-group'>";
					for(var i=0; i<n; i++){ 
						domString=domString+"<a class='selectSeries list-group-item' role='menuitem' tabindex='-1' href='#'>"+keys[i]+"</a>";
				
					 } 
					domString=domString+"</div>";
					$('.dropdown').show();
                    //console.log($('.col-md-4').height());
                    //$('.list-group').height($('.col-md-4').height()); //I dont know why this doesn't work...
                    $('.dropdown').empty();
					$('.dropdown').append(domString); 
					$('.progress').hide();//('hidden');
				}
			};
            return false; 
        });
        
        
        $('.dropdown').on('click', '.selectSeries', function(e){
            //console.log("got here");
            var attr=$(this);
            var remove=false;
            if(attr.hasClass('active')){
                remove=true;
                 attr.removeClass('active');
            }
            else {
                attr.addClass('active');
            }
            var value=attr.text();
            //console.log($(this));
            //console.log(value);
            //console.log(myChart);
            //attributes.push(value);//seems like there should be a more efficient way here..
            if(myChart){ 
                console.log("at add series");
                if(remove){
                    var numSeries=myChart.series.length;
                    console.log(myChart.series);
                    for(var i=0; i<numSeries; i++){ 
                        if(myChart.series[i].name===value){ //inefficient, but until the series gets a hashmap...
                            myChart.series[i].remove();
                            break;
                        }
                    }
                    
                }
                else{
                    
                    myChart.addSeries({                        
                        name: value,
                        data: data[value].Values
                    });
                }
                //var series=myChart.addSeries(value, dimple.plot.line, [xAxis, yAxis]);
                //series.data=data[value];
                //myChart.draw();                
           }
           else{
                //console.log(data);
                drawChart('chart', data[value], value);
           }
            return false;
        }); 
        
        
        function drawChart(element, data, name){
            myChart=new Highcharts.Chart({
                chart:{
                    type:'spline',
                    renderTo:element
                },
                title: {
                    text:""
                },
                credits:{
                    enabled:false
                },
                xAxis:{
                    categories:data.Time,
                    labels:{
                        formatter: function() {
                            return Highcharts.numberFormat(this.value,2, ".", ",");
                        }
                    }
                },
                yAxis:{
                    min:0
                },
                legend:{
                    enabled:false
                },
                 plotOptions: {
                    spline: {
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 4
                            }
                        },
                        marker: {
                            enabled: false
                        }
                    }
                }, 
                series:[
                    {
                        name:name, 
                        data:data.Values
                    }
                ]
            
            });
        
        }
        
        
    </script>
</head>