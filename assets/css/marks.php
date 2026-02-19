* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* BODY */
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #1d3557, #457b9d);
    color: #fff;
}

/* DASHBOARD LAYOUT */
.dashboard {
    display: flex;
    min-height: 100vh;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    background: rgba(0, 0, 0, 0.35);
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 22px;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin-bottom: 14px;
}

.sidebar ul li a {
    display: block;
    padding: 12px 15px;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
    font-size: 15px;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
    background: rgba(255, 255, 255, 0.25);
}

/* LOGOUT */
.sidebar ul li.logout a {
    background: #b00020;
}

.sidebar ul li.logout a:hover {
    background: #8f0019;
}

/* MAIN CONTENT */
.content {
    flex: 1;
    padding: 35px;
}

/* CARD */
.card {
    max-width: 800px;
    background: rgba(255, 255, 255, 0.15);
    padding: 25px;
    border-radius: 14px;
    backdrop-filter: blur(10px);
}

.card h2 {
    margin-bottom: 20px;
    text-align: center;
}

/* SUCCESS MESSAGE */
.success-msg {
    background: rgba(0, 200, 0, 0.25);
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
}

/* FORM GRID */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 18px;
}

/* FORM GROUP */
.form-group {
    display: flex;
    flex-direction: co
