// Disable Right-Click
document.addEventListener("contextmenu", function (event) {
    event.preventDefault();
});

// Disable Keyboard Shortcuts for DevTools
document.addEventListener("keydown", function (event) {
    if (
        event.key === "F12" || 
        (event.ctrlKey && event.shiftKey && event.key === "I") || // Ctrl + Shift + I (Inspect)
        (event.ctrlKey && event.key === "U") || // Ctrl + U (View Source)
        (event.ctrlKey && event.key === "J") || // Ctrl + Shift + J (Console)
        (event.ctrlKey && event.shiftKey && event.key === "C") // Ctrl + Shift + C (Elements)
    ) {
        event.preventDefault();
    }
});

// Detect DevTools (Debugger Trick)
function detectDevTools() {
    const before = new Date().getTime();
    debugger;
    const after = new Date().getTime();
    
    if (after - before > 100) {
        alert("Developer tools detected! Access is not allowed.");
        window.location.href = "about:blank"; // Redirect user
    }
}

// Check DevTools Every 1 Second
setInterval(detectDevTools, 1000);

// Prevent Text Selection
document.addEventListener("DOMContentLoaded", function () {
    document.body.style.cssText = `
        user-select: none; 
        -webkit-user-select: none; 
        -moz-user-select: none; 
        -ms-user-select: none;
    `;
});

// Crash Console with Infinite Loop
console.log = function () {
    while (true) {} // Freezes browser tab if DevTools is opened
};


