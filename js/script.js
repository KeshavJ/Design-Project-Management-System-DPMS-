$(document).ready(function(){

    $('#selectAllMon').click(function(event){

        if(this.checked){

            $('.checkMon').each(function(){

                this.checked = true;
            });

        }

        else{

            $('.checkMon').each(function(){

                this.checked = false;
            });
        }

    });  

    $('#selectAllTue').click(function(event){

        if(this.checked){

            $('.checkTue').each(function(){

                this.checked = true;
            });

        }

        else{

            $('.checkTue').each(function(){

                this.checked = false;
            });
        }

    }); 



});
