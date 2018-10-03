<?php
// include 'post.php';
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FormFields</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <script src="jquery/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
        <div class="container">
               <div class="row">
                   <div class="col-sm-4"></div>
                   <div class="col-sm-4 form-container">
                        <div class="header">
                            <h2> Form Fields </h2>
                        </div>
                        <div class="form-data">
                             <form  method="post">
                             <div class="input-group control-group after-add-more">
                                 <input type="text" class="form-control input" id="input-label-add" name='add' placeholder="" autocomplete='off'>
                                 <div class="input-group-btn">
                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                 </div>
                                 
                             </div>
                             
                             </form>
                        </div>
                   </div>
                   <div class="col-sm-4"></div>
               </div>
               <div class="row">
                   <div class="col-sm-3"></div>
                   <div class="col-sm-6">
                    
                       <div class="table-responsive-sm">
                      
                           <table class="table">
                               
                               <thead>
                                   <tr>
                                       <th scope="col">Names</th>
                                       <th scope="col">Amount</th>
                                   </tr>
                               </thead>
                               <tbody class="tbody">
                                     <?php
                                         include 'data.php';
                                     ?>
                               </tbody>
                           </table>
                           <div class='submit'>
                           <div class="submit-btn">
                                 <button type="button" class="submit btn btn-success" name='submit' id ="submit">Submit</button>
                             </div>
                               <?php
                               if(isset($error)){
                                   echo $error;
                               }
                               ?>
                           </div>
                           
                       </div>
                       <div class="error">
                       </div>
                       <div id="error">
                       </div>
                   </div>
                   <div class="col-sm-3"></div>
               </div>
        </div>
</body>
</html>
<script>
    $(document).ready(function(){

        // removing error notification
        $('#input-label-add').click(function(){
            $('#error').empty();
        });

        $('input[name^=empnames]').click(function(){
            $('.error').empty();
            $('#error').empty();
        });

        // Placeholder inform
        $('#input-label-add').click(function(){
            $('#input-label-add').attr('placeholder','');
        });

        // adding table data
        $('.add-more').click(function(){
            var value ='add';
            var name = $('#input-label-add').val();
            if(name !=''){
              $.ajax({
                  type:"POST",
                  url:"name.php",
                  data:{name:name,value:value},
                  function(data,status){
                      if(data=='success'){
                          console.log('Success');
                      }
                  }
              }); 

            $('#input-label-add').val('');
            $('.tbody').append("<tr class='row-ctrl'><td class='name' name='names[]'>"+name+"</td><td class='input-group control-group'><input type='text' class='form-control input' id='input-label-remove' name='empnames[]' autocomplete='off' required></td></tr>");
            
            }

            else{
                $('#input-label-add').attr('placeholder','Yup U Forgot Me!');
            }

        });

        // When Submit Button Click
         $('#submit').click(function(){
             var valid = true;
             var names=[];

             //getting all table data values
             $('td').each(function(){
                 names.push($(this).text());
             });
             
            //  removing invlaid space value in names
             $.each(names,function(index,val){
                 if(val==''){
                     if(index > -1){
                        names.splice(index,1);
                     }
                 }
             });

             //getting input field values
             var amount = $('input[name^=empnames]').map(function(index,elem){
                 return $(elem).val();
             }).get();

            
            //  console.log(amount);
            //  console.log(names);

            //  input field validation
             $.each(amount,function(index,val){
                 if(val===''){
                     $('.error').html("<span style='color:red;'>All Feilds are required</span>");
                     valid=false;
                 }
             });
            //  console.log(valid);

             if(names.length === 0){
                $('#error').html("<span style='color:red;'>All Feilds are required</span>");
                     valid=false;
            }
             
            if(valid==true){
                $("#submit").attr("disabled", true);

                $.ajax({
                  type:"POST",
                  url:"post.php",
                  data:{
                      names:names,
                      values:amount
                    },
                  function(data,status){
                      if(data=='success'){
                          console.log('Success');
                      }
                  }
              });
            }
         });


        // $('body').on('click','.btn-danger',function(){
        //      $(this).parents(".row-ctrl").remove();
             
        // });
    });
</script>