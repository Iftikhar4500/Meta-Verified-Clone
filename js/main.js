function validateForm(event) {
    var xs = document.getElementById('xs').value;
    if (!xs.includes('%')) {
        alert('The xs field must contain a % sign.');
        event.preventDefault(); // Prevent form submission
    }
}
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('verificationForm').addEventListener('submit', validateForm);
});
