function websiteLogin(form, btn, div){
    btn.click(function(){
        $.ajax({
            'type'  :   form.attr('method'),
            'url'   :   form.attr('action'),
            'data'  :   form.serialize(),
            'success':  function(data){
                if(data['msg'] == 'TRUE'){
                    $('.success-div').empty().append('<i class="fa fa-check"></i> Registration Successfull. You will be redirected to the home page in 3 seconds..');
                    setTimeout(function(){ location.href="/home"; }, 3000);
//                    location.href = '/home';
                }else{
                    div.empty().append(data['msg']);
                }
            },'error':  function(){
                div.empty().append('<i class="fa fa-warning"></i> No network connectivity.');
            }
        })
    });
}