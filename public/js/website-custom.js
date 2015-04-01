function websiteLogin(form, btn, div){
    btn.click(function(){
        $.ajax({
            'type'  :   form.attr('method'),
            'url'   :   form.attr('action'),
            'data'  :   form.serialize(),
            'success':  function(data){
                if(data['msg'] == 'TRUE'){
                    location.href = '/home';
                }else{
                    div.empty().append(data['msg']);
                }
            },'error':  function(){
                div.empty().append('<i class="fa fa-warning"></i> No network connectivity.');
            }
        })
    });
}