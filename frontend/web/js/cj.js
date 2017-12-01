
$("#pjax-first").on("pjax:end", function() {
    var top = $('#companies').offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
    dataklinktohref();
});


$("#torecomend").on("click", function(e) {
    e.preventDefault();
    var top = $('#recomend').offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
});
var top_show = 250; 
$(document).ready(function() {
    $(window).scroll(function () { 
      if ($(this).scrollTop() > top_show) $('#totop').fadeIn();
      else $('#totop').fadeOut();
    });
    $('#totop').click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, 1000);
    });
  });
function likecomm(id)
{
    $.get('/company/plus', {id : id}, function(data){
        var data= $.parseJSON(data);
        if(data.likes!="no")
            $('.count_likes'+id).html(' '+data.likes+' ');
        else
            $('#myModal').modal('show');
   });
}
function dislikecomm(id)
{
    $.get('/company/minus', {id : id}, function(data){
        var data= $.parseJSON(data);
        if(data.likes!="no")
            $('.count_likes'+id).html(' '+data.likes+' ');
        else
            $('#myModal').modal('show');
   });
}
$('.foottitle').on('click', function(){
    if ($(window).width() <= '749'){
        var id=$(this).attr('data-acp');
        if($('.acdiv'+id).css('display')=='none')
        {
            $('.acdiv'+id).css('display', 'block');
            $('.znak'+id).removeClass('fa-plus').addClass('fa-minus');
        }
        else if($('.acdiv'+id).css('display')=='block')
        {
            $('.acdiv'+id).css('display', 'none');
            $('.znak'+id).removeClass('fa-minus').addClass('fa-plus');
        }
    }
});

function dataklinktohref()
{
    $(".sort_right a").each( function setLink() {
          $(this).attr('href', $(this).attr('data-h')); 
    });
    $(".payment_right a").each( function setLink() {
          $(this).attr('href', $(this).attr('data-h')); 
    });
    $(".age_right a").each( function setLink() {
          $(this).attr('href', $(this).attr('data-h')); 
    });
}
$(document).ready(function() {
   dataklinktohref();
});
$("#pjax-second").on("pjax:end", function() {
   dataklinktohref();
});
$("#pjax-landing").on("pjax:end", function() {
   dataklinktohref();
});

//view _wall

var sochas=false;
$(document).scroll(function() {
    var top = $("#wall").offset().top;
    var doctop=$("html").scrollTop();
    var id = $('#wall').data('id');
    if((doctop >= top - $(window).height()) && !sochas)
    {
        $.ajax({
            url: '/company/wall',
            type: 'GET',
            data: {id : id},
            success: function(data)
            {
                $('#wall').html(data); //вставляет хтмл в код
            },
            error: function()
            {
                alert('Не удалось получить стену');
            }
        });
        sochas=true;
    }
});

$(document).ready(function() {
    if($('#page-recommended').val() == true)
        $('.field-page-photo').css('display', 'block');
    else
        $('.field-page-photo').css('display', 'none');
});

$('#page-recommended').on('change', function(){
    if($('#page-recommended').val() == true)
        $('.field-page-photo').css('display', 'block');
    else
        $('.field-page-photo').css('display', 'none');
});
