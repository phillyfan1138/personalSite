<!DOCTYPE html>
 
<html class='main'>
<head>
<?php include 'assets/includes/header.php';?>
 
 <link rel='stylesheet' type='text/css' href='css/frontPageStyles.css' />
 
<style type="text/css">
    #displayName {
        position:fixed;
        z-index:999;
        width:100%;
        /*margin-top:15px;*/
        padding-top:15px;
        visibility:inherit;
        opacity:1;
    }
    #name {
        padding-left:15px; /*to align with "productivity" */
    
    }
    .afterElement{
        color:black;  
        opacity:1;
    }
    hr{
        border-color:black;
        opacity:0;
    }
</style>
 
</head>

<body class='main'>               
    <div id='displayName' >
        <div class='container' id='name'>
        
          Daniel Stahl 
                     
        </div>
        <hr> 

    </div>   
    <section class="panel" id='first'>
       <!-- <div class="container" id='displayName'>
          
            <div class='col-md-8'  style="visibility:inherit; opacity:1; ">
                Daniel Stahl  
            </div>
             

        </div>     -->                                           
                       
        
    </section>
    <section id='prod' class="panel productivity">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='subTitle productivity col-md-4' id='productivityDesc'>
                <!--<div class='background productivity' id='productivityDesc'>-->
                    Productivity
                </div>
                <div class='col-md-8 txt'>
                <!--<div class='col-md-12 txt'>  -->
                    Humans are naturally creative thinkers.  Many mundane and repetitive tasks are delegated to humans in the corporate world.  These are the tasks at which computers are superior.  My passion is to realize productivity enhancements through the proper design of workflows so that the workload is optimally divided between man and machine.  A happy byproduct of such an optimization is a technically superior, critically engaged workforce.                                                               
                </div>
            </div>            
        </div>
    </section>
    <section class="panel data">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='subTitle data col-md-4' id='dataDesc'>
                    Data Management
                </div>
                <div class='col-md-8 txt'>
                   The purpose of data is to deliver information to humans in an actionable form. This purpose implies data availability, data integrity, and data connectivity.  To help achieve this purpose, I have self-imposed the following criteria:
                   <ul>
                   <li>Every data table that I create will have a primary key.  </li>
                   <li>In the nearly universal case that more than one table is required to maintain efficient and normalized data, every pertinent table will have at least one foreign key. </li>
                   </ul>
                   
                   This purpose also precludes humans from ever altering, viewing, or touching data at any granular level.  Humans were not intended to accurately and efficiently process data.
                </div>
                       
            </div>
        </div>
    </section>
    
    
    
     <section class="panel model">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='subTitle model col-md-4' id='modelDesc'>
                    Mathematical Modeling 
                </div>
                <div class='col-md-8 txt'>
                
                    The purpose of a model is to interpret data for human consumption.  The use of mathematical sophistication implies that models are most useful when applied to a complex problem.  The constraint on a model is that to add value to the decision making process of a human, it must be computationally efficient, it must have output that is applicable and understandable to the audience, and it must be reliable.  As with data, I have self-imposed the following constraints in creating a model:
                    <ul>
                    <li> The model must be parsimonious</li>
                    <li> The model must, whenever practicable, have a semi-analytical solution (to the point that efficient methods of solutions can achieved)</li>
                    <li> The model must be repeatable.</li>
                    <li> The model must be have a GUI interface.</li>
                    
                    </ul>
                </div> 
                
                           
            </div>
        </div>
    </section>
    
    <?php include 'assets/includes/menu.php';?> <!--side menu -->

    
</body>
   <?php include 'assets/includes/footerScripts.php';?> <!--final includes for side menu -->
<script>
    $(function () { // wait for document ready
        var isMobile=false;
        
        
        if(screen.width<=480){ //then mobile
            isMobile=true; 

        }
        // init
        var controllerWipes = new ScrollMagic.Controller({
            globalSceneOptions: {
                triggerHook: 'onLeave'
            }
        });
        

        if(!isMobile){
            var blockTween = new TweenMax.to('#displayName', 1, {
                    //backgroundColor: 'red'
                    top: 0
                }); 
            new ScrollMagic.Scene({  
                triggerElement: $('body')[0],
                duration: '70%' //$(this).height()
            })
            //.setPin('#displayName')
            .setTween(blockTween)
            //.addIndicators() // add indicators (requires plugin)
            .addTo(controllerWipes);
            
            /*this is a new attempt to fix "Daniel Stahl" to the top */
            /*new ScrollMagic.Scene({
                    triggerElement: $("#prod")[0] 
                })
                .setPin('#displayName')
                .addTo(controllerWipes); */
             

             /*set the hamburger bar */
             new ScrollMagic.Scene({  
                triggerElement:$("#prod")[0]//,
               // duration: '70%' //$(this).height()
            })
            //.setTween(colorTween) 
            .setClassToggle(".bt-menu-trigger", "afterElement") //I hope this works..
            .addTo(controllerWipes); 
            
            
            /*set the "daniel stahl" */
            new ScrollMagic.Scene({  
                triggerElement:$("#prod")[0]//,
               // duration: '70%' //$(this).height()
            })
            //.setTween(colorTween) 
            .setClassToggle("#name", "afterElement") //I hope this works..
            .addTo(controllerWipes);
            
             /*set the "line" */
            new ScrollMagic.Scene({  
                triggerElement:$("#prod")[0]//,
               // duration: '70%' //$(this).height()
            })
            //.setTween(colorTween) 
            .setClassToggle("hr", "afterElement") //I hope this works..
            .addTo(controllerWipes);
           
            $('section.panel').each(function(index, value){ 
       
               
                new ScrollMagic.Scene({
                        triggerElement: value 
                    })
                    .setPin(value)
                    //.addIndicators() // add indicators (requires plugin)
                    .addTo(controllerWipes); 
            
        
            });
        }
        

    });
</script>
</html>