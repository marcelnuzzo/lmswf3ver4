$('#add-answer').click(function(){
    //Je récupère le numéro des futurs champs que je vais créer
    const index = +$('#widgets-counter').val();
    console.log(index);

    //Je récupère le prototype des entrées
    const tmpl = $('#quiz5_answers').data('prototype').replace(/__name__/g, index);

    //J'injecte ce code au sein de la div
    $('#quiz5_answers').append(tmpl);

    $('#widgets-counter').val(index + 1);

    //Je gère le bouton supprimer
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#quiz5_answers div.form-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();