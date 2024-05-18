import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/style.min.css',
        'resources/js/bootstrap.js',
        'resources/js/profile.js',
        'resources/js/register.js',
        'resources/js/slider-orders.js',
        'resources/js/reviews/form-submit.js',
        'resources/js/reviews/generate-stars.js',
        'resources/js/reviews/star-rating.js',
        'resources/js/reviews/admin/approve-review.js',
        'resources/js/reviews/admin/delete-review.js',
        'resources/js/reviews/admin/reject-review.js',
        'resources/js/components/accordion.js',
        'resources/js/components/add-to-cart.js',
        'resources/js/components/custom-file.js',
        'resources/js/components/favtotal.js',
        'resources/js/components/feedback-modal.js',
        'resources/js/components/modal-functions.js',
        'resources/js/components/phone-mask.js',
        'resources/js/product/properties.js',
        'resources/js/product/update-properties.js',
      ],
      refresh: true,
    }),
  ],
});