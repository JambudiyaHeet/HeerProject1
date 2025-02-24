// //function manage_cart(pid, type) {
// //     $.ajax({
// //         url: 'manage_cart.php',
// //         type: 'POST',
// //         data: {
// //             pid: pid,
// //             type: type
// //         },
// //         success: function(response) {
// //             if(type == 'remove') {
// //                 // Remove the product row from the table
// //                 $('tr[data-pid="'+pid+'"]').remove();
// //                 // Update cart count
// //                 $('.htc__qua').text(response);
// //             }
// //             // Reload the page to reflect changes
// //             location.reload();
// //         },
// //         error: function(xhr, status, error) {
// //             console.error('Error managing cart:', error);
// //             alert('An error occurred while updating the cart.');
// //         }
// //     });
// // }
// console.log("JS File Loaded");

// function manage_cart(pid, type) {
//   let qty = type === "update" ? $("#" + pid + "qty").val() : 1;

//   $.ajax({
//     url: "manage_cart.php",
//     type: "POST",
//     data: {
//       pid: pid,
//       qty: qty,
//       type: type,
//     },
//     dataType: "json", // Expecting JSON response
//     success: function (response) {
//       if (type === "remove") {
//         $('tr[data-pid="' + pid + '"]').remove();
//         $(".htc__qua").text(response.totalProducts);
//       } else if (type === "update") {
//         let newSubtotal = response.subtotal;
//         $('tr[data-pid="' + pid + '"] .product-subtotal').text(newSubtotal.toFixed(2)); // Ensure proper formatting
//         $(".htc__qua").text(response.totalProducts);
//       }
//     },
//     error: function (xhr, status, error) {
//       console.error("Error managing cart:", error);
//       alert("An error occurred while updating the cart.");
//     },
//   });
// }

// console.log("JS File Loaded");
// function manage_cart(pid, type) {
//   $.ajax({
//     url: "manage_cart.php",
//     type: "POST",
//     data: {
//       pid: pid,
//       type: type,
//     },
//     success: function (response) {
//       if (type == "remove") {
//         // Remove the product row from the table
//         $('tr[data-pid="' + pid + '"]').remove();
//         // Update cart count
//         $(".htc__qua").text(response);
//       }
//       // Reload the page to reflect changes
//       location.reload();
//     },
//     success: function (response) {
//       if (type == "remove") {
//         // Remove the product row from the table
//         $('tr[data-pid="' + pid + '"]').remove();
//         // Update cart count
//         $(".htc__qua").text(response);
//         // Reload the page to reflect changes
//         location.reload();
//       } else if (type == "update") {
//         // Update the total price for the updated product
//         let price = $(
//           'tr[data-pid="' + pid + '"] .product-price .amount'
//         ).text();
//         let qty = $("#" + pid + "qty").val();
//         let newSubtotal = price * qty;

//         // Update the subtotal in the table
//         $('tr[data-pid="' + pid + '"] .product-subtotal').text(newSubtotal);

//         // Update cart count
//         $(".htc__qua").text(result);

//         // Optionally, reload the page to reflect changes
//         location.reload();
//       }
//     },

//     error: function (xhr, status, error) {
//       console.error("Error managing cart:", error);
//       alert("An error occurred while updating the cart.");
//     },
//   });
// }

function manage_cart(pid, type) {
  let qty = $("#" + pid + "qty").val(); // Get quantity for update

  $.ajax({
    url: "manage_cart.php",
    type: "POST",
    data: {
      pid: pid,
      type: type,
      qty: qty // Ensure qty is sent when updating
    },
    success: function (response) {
      if (type === "remove") {
        // Remove the product row from the table
        $('tr[data-pid="' + pid + '"]').remove();

        // Update cart count
        $(".htc__qua").text(response);

      } else if (type === "update") {
        let price = $('tr[data-pid="' + pid + '"] .product-price .amount').text();
        if(qty<0){
            qty=0;
        }
        let newSubtotal = price * qty;
        // $_SESSION['cart'][$pid]['qty']=qty;

        // Update the subtotal in the table
        $('tr[data-pid="' + pid + '"] .product-subtotal').text(newSubtotal);
        
        // Update cart count from the response
        let result = JSON.parse(response); 
        $(".htc__qua").text(result.totalProducts);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error managing cart:", error);
      alert("An error occurred while updating the cart.");
    }
  });
}
