document.addEventListener('DOMContentLoaded', function() {
  // Add to cart button click event
  document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', function() {
          const itemId = this.dataset.itemId;
          const quantity = this.closest('form').querySelector('input[type="number"]').value;

          fetch('add_to_cart.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `item_id=${itemId}&quantity=${quantity}&add_to_cart=true`
          }).then(response => response.json())
            .then(data => {
                updateCartUI(data);
            });
      });
  });

  // Remove from cart button click event
  document.querySelectorAll('.remove-from-cart').forEach(button => {
      button.addEventListener('click', function() {
          const itemId = this.dataset.itemId;

          fetch('remove_from_cart.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `item_id=${itemId}&remove_from_cart=true`
          }).then(response => response.json())
            .then(data => {
                updateCartUI(data);
            });
      });
  });

  function updateCartUI(cart) {
      const cartCount = document.querySelector('.badge');
      cartCount.textContent = Object.keys(cart).length;

      const cartContent = document.querySelector('.cart-table');
      cartContent.innerHTML = '';

      Object.entries(cart).forEach(([itemId, quantity]) => {
          const row = document.createElement('tr');
          row.innerHTML = `
              <td>${itemId}</td>
              <td>${quantity}</td>
              <td><button class="remove-from-cart" data-item-id="${itemId}">Remove</button></td>
          `;
          cartContent.appendChild(row);
      });
  }
});