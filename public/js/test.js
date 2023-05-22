$('.btn-download').on('click', function (e) {
    if (!this.hasAttribute('href')) {
        if (this.getAttribute('value') != 0) {
            url = window.location.origin + $(this).attr('value');
            fetch(url).then(res => res.blob()).then(file => {
                let tempURL = URL.createObjectURL(file);
                this.setAttribute('href', tempURL)
                this.setAttribute('download', url.replace(/^.*[\\\/]/, ''))
                this.removeAttribute('value');
                this.click();
                URL.revokeObjectURL(tempURL);
            }).catch((e) => {
                console.error(e);
            });
        } else {
            let carousel = $(this).parents('header').next();
            let activeItem = carousel.find('.active');
            let image = activeItem.find('img').attr('src');
            url = window.location.origin + image;
            fetch(url).then(res => res.blob()).then(file => {
                let tempURL = URL.createObjectURL(file);
                this.setAttribute('href', tempURL)
                this.setAttribute('download', url.replace(/^.*[\\\/]/, ''))
                this.click();
                URL.revokeObjectURL(tempURL);
                this.removeAttribute('href');
            }).catch((e) => {
                console.error(e);
            });
        }
    }
});