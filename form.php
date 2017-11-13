<?php include 'top.php'; ?>
<h1>Custom Cake Orders</h1>
<p>Having an event or celebration? Leave the cake to us! Let us know what you want and we'll do the rest. We will work with you at every step to ensure your cake is to your satisfaction.</p>
<div class="form-right">
    <h2 class="some-work">Some of Our Work</h2>
</div>
<div class="form-left">
    <form class="form">
        <fieldset class="fieldset">
            <label class="name">
                Name:
                <input type="text" name="name" size="30" maxlength="100">
            </label>
            <br />
            <label class="email">
                Email:
                <input type="email" name="email" size="30" maxlength="100">
            </label>
            <br />
            <label class="phone">
                Phone:
                <input type="tel" name="usrtel" size="30" maxlength="100">
            </label>
            <br />
            <label class="occasion">
                Occasion:
                <input type="text" name="occasion" size="30" maxlength="100">
            </label>
            <br />
            <label class="occasion-date">
                Date of Occasion:
            </label>
            <select name="month" id="month">
                <option value="month">Month</option>
                <option value="january">January</option>
                <option value="february">February</option>
                <option value="march">March</option>
                <option value="april">April</option>
                <option value="may">May</option>
                <option value="june">June</option>
                <option value="july">July</option>
                <option value="august">August</option>
                <option value="september">September</option>
                <option value="october">October</option>
                <option value="november">November</option>
                <option value="december">December</option>
            </select>
            <select name="month" id="month">
                <option value="date">Date</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <select name="year" id="year">
                <option value="year">Year</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
            </select>
            <br />
            <label class="occasion-time">
                Time of Delivery:
            </label>
            <select name="hour" id="hour">
                <option value="hour">Hour</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select name="minute" id="minute">
                <option value="minute">Minute</option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
            </select>
            <select name="AM" id="AMPM">    
                <option value="13">AM</option>
                <option value="14">PM</option>
            </select>
            <br />
            <label class="sponge">
                Sponge:
                <input type="checkbox" name="sponge" value="vanilla" /> Vanilla
                <input type="checkbox" name="sponge" value="chocolate" /> Chocolate
                <input type="checkbox" name="sponge" value="redvelvet" /> Red Velvet
                <input type="checkbox" name="sponge" value="orange" /> Orange 
                <input type="checkbox" name="sponge" value="lemon" /> Lemon
            </label>
            <br />
            <label class="filling">
                Filling:
                <input type="checkbox" name="filling" value="buttercream" /> Buttercream
                <input type="checkbox" name="filling" value="cremepat" /> Crème Pâtissière
                <input type="checkbox" name="filling" value="ganache" /> Ganache
                <input type="checkbox" name="filling" value="freshfruit" /> Fresh Fruit
                <input type="checkbox" name="filling" value="jam" /> Jam
            </label>
            <br />
            <label class="frosting">
                Frosting
            </label>
            <select name="frosting" id="frosting">
                <option value="select">Select</option>
                <option value="buttercream">Buttercream</option>
                <option value="ganache">Ganache</option>
                <option value="mirror">Mirror Glaze</option>
            </select>
            <br />
            <label class="size">
                Size:
                <input type="radio" name="size" value="6round" /> 6in. round
                <input type="radio" name="size" value="8round" /> 8in. round
                <input type="radio" name="size" value="9round" /> 9in. round
                <input type="radio" name="size" value="11x13" /> 11x13in. rectangle
                <input type="radio" name="size" value="1/2sheet" /> 1/2 sheet
            </label>
            <br />
            <label class="layers">
                Layers:
                <input type="radio" name="layers" value="1" /> 1
                <input type="radio" name="layers" value="2" /> 2
                <input type="radio" name="layers" value="3" /> 3
                <input type="radio" name="layers" value="4" /> 4
            </label>
            <br />
            <input class="submit-order" type="submit" value="Submit" />
        </fieldset>  
    </form>
</div>
<?php include 'footer.php'; ?>
