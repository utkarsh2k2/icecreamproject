jQuery(document).ready(function () {
    $('.discount-collection').collection({
        min: 1,
        allow_duplicate: false,
        allow_up: false,
        allow_down: false,
        add: '<a href="#" class="btn btn-default" title="Add element"><i class="fa fa-plus" aria-hidden="true"></i></a>',
        // here is the magic!
        elements_selector: 'tr.item',
        elements_parent_selector: '%id% tbody',
    });

    $('.topping-items').chosen({
        display_selected_options: false,
        width: "100%",
        placeholder_text_multiple: 'Select Toppings',
        no_results_text: "Oops, no Topping found!"
    });
});