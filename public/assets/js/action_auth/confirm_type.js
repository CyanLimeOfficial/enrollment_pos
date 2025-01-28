function confirmDelete(event, userId) {
    // Show a prompt asking the user to type 'CONFIRM'
    const userInput = prompt("To confirm deletion, please type 'CONFIRM':");

    // Check if the user typed CONFIRM
    if (userInput === "CONFIRM") {
        // If confirmed, submit the form
        document.getElementById('delete-user-form-' + userId).submit();
    } else {
        // Prevent form submission if the input is incorrect
        alert("Deletion canceled. You must type 'CONFIRM' to delete the user.");
        event.preventDefault();
    }
}
