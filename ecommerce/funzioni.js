function toUpdateQuantityCart(id, q, max) {
    if (q != 0 && q != (max + 1))
        window.location = "modificaQuantità.php?id=" + id + "&q=" + q;
}

function toRemoveFromCart(id) {
    window.location = "rimuoviDalCarrello.php?id=" + id;
}

function toCleanCart() {
    window.location = "pulisciCarrello.php";
}

function toCheckout() {
    window.location = "checkout.php";
}
function toAddToCart(id, q) {
    window.location = "aggiungiAlCarrello.php?id=" + id + "&q=" + q;
}



function toDeleteArticle(id) {
    window.location = "eliminaArticolo.php?id=" + id;
}
function toAddArticle() {
    window.location = "aggiungiArticolo.php";
}






function toDeletePaymentMethod(id) {
    window.location = "check/deletePaymentMethod.php?id=" + id;
}

function caricaPopup(text, type) {
    $.bootstrapGrowl(text, {
        ele: 'body', // which element to append to
        type: type, // (null, 'info', 'error', 'success')
        offset: { from: 'top', amount: 30 }, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        delay: 2000,
        allow_dismiss: false,
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}