// let timeout;
// let currentSort = 'asc';
// let currentSearch = '';

// $(document).ready(function(){

//     // SEARCH
//     $('#search').on('keyup', function() {
//         clearTimeout(timeout);
//         currentSearch = $(this).val();

//         timeout = setTimeout(function() {
//             loadData();
//         }, 500);
//     });

//     // SORT
//     $('#sort-id').on('click', function() {
//         currentSort = currentSort === 'asc' ? 'desc' : 'asc';
//         loadData();
//     });

//     // PAGINATION
//     $(document).on('click', '.pagination a', function(e) {
//         e.preventDefault();
//         let url = $(this).attr('href');
//         loadData(url);
//     });

//     // COMMON FUNCTION 🔥
//     function loadData(url = studentUrl) {
//         $.ajax({
//             url: url,
//             type: 'GET',
//             data: {
//                 search: currentSearch,
//                 sort: currentSort
//             },
//             success: function(response) {
//                 $('#students-data').html($(response).find('#students-data').html());
//             },
//             error: function() {
//                 alert('Something went wrong');
//             }
//         });
//     }

// });