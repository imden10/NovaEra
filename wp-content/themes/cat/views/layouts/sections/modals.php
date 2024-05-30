<div class="modal-form-wrapper" onclick="modalFormHide(event)">
    <div class="modal-form">
        <div class="modal-form--btn-close ic-close" onclick="modalFormHide(event)">
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

    function modalFormHide(event) {
        if (event.target === event.currentTarget) {
            document.querySelector('.modal-form-wrapper').classList.remove('modal-form-show');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modalFormHide();
        }
    });
</script>