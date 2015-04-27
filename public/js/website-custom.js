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

function scripts_HomePage(){
    setInterval(function(){
        var randNum = randomIntFromInterval(2,12);
        $('body').css('background-image','url("/images/body/'+randNum+'.jpg")');
    }, 5000);

    $('.article-trigger').click(function(){
        $('.body1').show();
        $('.body2').hide();
        var artId = $(this).attr('data-artid');

        $('.articleModal-header').empty().append('<center><font style="font-size : 1.8em">'+ $('.title_'+artId).text() +'</font></center>');
        $('.articleModal-body').empty().append($('.article_'+artId).text());

        var img = $('.image_'+artId).clone();
        $('.articleModal-img').empty().append(img);

        setTimeout(function(){
            $('.body1').hide();
            $('.body2').fadeIn();
        }, 1000);

        $('#articleModal').modal('show');
    })
}

function randomIntFromInterval(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}

function scripts_Master(){
    $('.contact-us-btn').click(function(){
        $('#contactUsModal').modal().show();
    });

    $('.links').click(function(){
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    })
}