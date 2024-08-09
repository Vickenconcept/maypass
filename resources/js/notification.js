export default () => ({
    notify(message, color) {
        Toastify({
            text: message,
            duration: 3000,
            gravity: 'top',
            style: {
                background: color,
              },
        }).showToast();
    }

});