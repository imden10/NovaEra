<div class="modal-form-wrapper">
    <div class="modal-form">
        <div class="modal-form--btn-close ic-close" onclick="modalFormHide()">
        </div>
        <div class="modal-form-content">
            Content
        </div>
    </div>
</div>

<script>
    function modalFormShow() {
        document.querySelector('.modal-form-wrapper').classList.add('modal-form-show');
    }

    function modalFormHide() {
        document.querySelector('.modal-form-wrapper').classList.remove('modal-form-show');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modalFormHide();
        }
    });
</script>