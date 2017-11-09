<div>
<nav id="nav" class="navcenter-parent">
    <ul class="navcenter">
        <?php
        print '<li class="home';
        if ($path_parts['filename'] == "home") {
            print ' activePage ';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "breakfast") {
            print ' activePage ';
        }
        print '">';
        print '<a href="breakfast-all.php">Breakfast</a>';
        print '</li>';
        
        print '<li class="';
        if ($path_parts['filename'] == "lunch") {
            print ' activePage ';
        }
        print '">';
        print '<a href="lunch-all.php">Lunch</a>';
        print '</li>';
        
                print '<li class="';
        if ($path_parts['filename'] == "dinner") {
            print ' activePage ';
        }
        print '">';
        print '<a href="dinner-all.php">Dinner</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "dessert") {
            print ' activePage ';
        }
        print '">';
        print '<a href="dessert-all.php">Dessert</a>';
        print '</li>';
        
        print '<li class="';
        if ($path_parts['filename'] == "snacks") {
            print ' activePage ';
        }
        print '">';
        print '<a href="snacks-all.php">Snacks</a>';
        print '</li>';
        
        print '<li class="order"';
        if ($path_parts['filename'] == "order") {
            print ' activePage ';
        }
        print '">';
        print '<a href="form.php">Order</a>';
        print '</li>';
        ?>
    </ul>
</nav>
</div>