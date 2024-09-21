// $(document).ready(function(){
    function message(type, content){
        if (type == "success"){
            $("#message").removeClass("alert-danger")
            $("#message").addClass("alert-success")

        }else{
            $("#message").removeClass("alert-success")
            $("#message").addClass("alert-danger")
        }
        $("#message").html(content)
        $("#message").show()

        window.scrollTo({
            top: 0,
            behavior: 'smooth' 
        });

    }

    function reset(){
        $("#registerform :input").each(function() {
            if ($(this).is('input') || $(this).is('select') || $(this).is('textarea')) {
                $(this).val('');  // Set value to empty
            }
        });
        // $("#message").hide()
    }


    $("#openNav").click(function(){
        $('#mySidenav').addClass('sidenav-open');
        $('#mainContent').addClass('main-open');
    })
    

    $("#closeNav").click(function(){
        $('#mySidenav').removeClass('sidenav-open');
        $('#mainContent').removeClass('main-open');
    })


    $("#logout").click(function(){
        $(".loader").show()
        $("#certify").hide()
        $("#verifyfield").show()
        $(".loader").hide()

    })
    
// });