function formatStateIcon (state) {
    if (!state.id) {
        return state.text;
    }
    if(state.element.dataset.icon && state.element.dataset.icon !== "non"){
        var $state = $(
            '<span class="'+state.element.dataset.icon+'"></span>'
        );
    } else {
        var $state = $(
            '<span> ' + state.text + '</span>'
        );
    }
    return $state;
};