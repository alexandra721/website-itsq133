function ajaxLogin(formMain, formButton, divMsg, formInput){
    formButton.click(function(){
        var bool = false;
        for(var i = 0; i < formInput.size(); i++){
            if(formInput.eq(i).val().length == 0 || formInput.eq(i).val().length < 5){
                bool = true;
            }
        }

        if(bool){
            divMsg.empty().append(' <i class="fa fa-warning" style="color: #E74C3C"></i> Input must have 5 or more characters');
        }else{
            $.ajax({
                type    : 'POST',
                url     : formMain.attr('action'),
                data    : formMain.serialize(),
                success : function(data){
                    if(data['bool']){
                        location.href = "/admin/home";
                    }else{
                        divMsg.empty().append(' <i class="fa fa-warning" style="color: #E74C3C"></i> Invalid login credentials');
                    }
                },error : function(){

                }
            })
        }
    })
}