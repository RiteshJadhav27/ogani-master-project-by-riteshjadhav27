window.addEventListener('DOMContentLoaded', () => {  
    fetch(`./Backend/auth/loggedin.php`)
    .then(resp => resp.json())
    .then((res) => {
        const headLoginButton = document.getElementById('headLoginButton');

        if (res.stat === true) {
            // User is logged in
            if (headLoginButton) {
                headLoginButton.parentElement.innerHTML = `
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-user"></i> Hi, ${res.user.name}!</button>
                        <div class="dropdown-content">
                            <a href="./Backend/auth/logout.php">Logout</a>
                        </div>
                    </div>`;
            }
        }
    })
    .catch(error => console.error('Error fetching loggedin.php:', error));
});
