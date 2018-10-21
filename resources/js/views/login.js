const init = () => {
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        //return false;
    });
};
export {init}

