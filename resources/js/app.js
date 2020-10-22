window.filterInquiries = function () {
    const params = {
        season: $('.inquiries:checked').val(),
    }

    var queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
}


window.radioFilter = function (item, val) {
    const parent = $(item).closest('.inquiries-list');
    $(parent).find('label').removeClass('active');
    $(item).closest('label').addClass('active');
    filterInquiries();
}

// $(document).ready(function () {
//     filterInquiries();
// })