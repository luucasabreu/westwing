$(document).ready(function(){
    $('form[action]').not('.without-validation').each(function(){
        $(this).bind('submit');

        $(this).on('submit', function(event){
            event.preventDefault();
            event.stopPropagation();

            var form = $(this);

            submit(form);
        });
    });

    function submit(form)
    {
        var condition = false;

        form.find('.form-control:input').not('.not-required').not('button').each(function(){
            var value = $(this).val();

            $(this).removeClass('warning');
            $(this).parent().find('.invalid-field').remove();

            if(!value || value === ''){
                $(this).addClass('warning');
                $(this).parent().append('<p class="invalid-field">Campo obrigatório!</p>');

                condition = true;
            }
        });

        var count = form.find('.invalid').length;

        if(!condition && count <= 0){
            form.unbind('submit');

            form.submit();
        }
    }
});
