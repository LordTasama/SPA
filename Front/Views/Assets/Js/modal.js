const SetModal = (title, body, footer) => {
    document.getElementById('staticBackdrop').innerHTML = `
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-body-secondary">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">${title}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">${body}</div>
            <div class="modal-footer bg-body-secondary">${footer}</div>
        </div>
    </div>
    `;
};
const ShowModal = (options) => {
    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), options);
    myModal.show();
};
export {
    SetModal,
    ShowModal
};