<header style="background:black; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center;">
    
    <!-- Logo / Dashboard -->
    <div style="font-size:20px; font-weight:bold;">
        <a  style="color:white; text-decoration:none;">ElectroShop</a>
    </div>

    <!-- Navigation centrée -->
    <nav style="display:flex; gap:30px; justify-content:center; flex:1;">
        <a href="dashboard.php" class="nav-link">Dashboard</a>
        <a href="products.php" class="nav-link">Products</a>
        <a href="order.php" class="nav-link">Commandes</a>
        <a href="user.php" class="nav-link">Users</a>
    </nav>

    <!-- User menu à droite -->
    <div style="display:flex; align-items:center; gap:10px;">
        <span>👤 Admin</span>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

</header>

<style>
    /* Style des liens du nav avec underline hover */
    nav a.nav-link {
        color: white;
        text-decoration: none;
        position: relative;
        padding: 2px 0;
    }

    nav a.nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        text-decoration: none;
        left: 0;
        bottom: -3px;
        background-color: white;
        transition: width 0.3s ease;
    }

    nav a.nav-link:hover::after {
        width: 100%;
    }

    /* Logout button hover lift */
    .logout-btn {
        background: #afadadff;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
        transition: transform 0.2s ease;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        background: transparent;
    }
</style>
