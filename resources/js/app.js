import './bootstrap';
// Animation pour les messages flash
document.addEventListener('DOMContentLoaded', function() {
 // Auto-hide flash messages after 5 seconds
 const flashMessages = document.querySelectorAll('[role="alert"]');
 flashMessages.forEach(function(message) {
 setTimeout(function() {
 message.style.transition = 'opacity 0.5s ease-out';
 message.style.opacity = '0';
 setTimeout(function() {
 message.remove();
 }, 500);
 }, 5000);
 });
});
// Confirmation avant suppression
window.confirmDelete = function(callback) {
 if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
 callback();
 }
}
// Smooth scroll pour les modales
window.scrollToTop = function() {
 window.scrollTo({
 top: 0,
 behavior: 'smooth'
 });
}