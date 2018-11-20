
<html>
<head>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script>
        const app = new Vue({
            el: '#app',
            data: {
                errors: [],
                searchterm: null,
                number: null
            },
            methods:{
                checkForm: function (e) {
                    if (this.searchterm) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.searchterm) {
                        this.errors.push('Search Term required.');
                    }
                    e.preventDefault();
                }
            }
        })
    </script>
<style>

    .form{
        min-width: 0;
        width: 50%;
        display: inline;
    }

    input {
        width: 30%;
    }

    .msg{color: red}
    .other{color: black;text-align: center}
</style>

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Home Page</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/saved_videos">All Saved Videos</a></li>
        </ul>
    </div>
</nav>

<?php


if (!empty($_GET['msg'])){
    echo "<div class='msg'>".$_GET['msg'].": &nbsp;&nbsp;";
    for ($i = 0; $i < count($_GET['title']); $i++) {
        echo"<strong>". $_GET['title'][$i]."</strong><br>";
        echo"</div>";
    }
}
?>

<div class = "other">
<h2>Search YouTube Videos</h2>
<form
@submit="checkForm"
action="/process"
method="post"
class ="form"
>

<p>
    <label for="searchterm">Search Term</label><br>
    <input
        id="searchterm"
        v-model="searchterm"
        type="searchterm"
        name="searchterm"
    >
</p>

<p>
    <label for="number">Number of Videos</label>&ensp;

    <select
            id="number"
            v-model="number"
            name="number"
    >

    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>

    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
    <option>16</option>
    <option>17</option>
    <option>18</option>
    <option>19</option>
    <option>20</option>

    <option>21</option>
    <option>22</option>
    <option>23</option>
    <option>24</option>
    <option>25</option>
    <option>26</option>
    <option>27</option>
    <option>28</option>
    <option>29</option>
    <option>30</option>

    <option>31</option>
    <option>32</option>
    <option>33</option>
    <option>34</option>
    <option>35</option>
    <option>36</option>
    <option>37</option>
    <option>38</option>
    <option>39</option>
    <option>40</option>

    <option>41</option>
    <option>42</option>
    <option>43</option>
    <option>44</option>
    <option>45</option>
    <option>46</option>
    <option>47</option>
    <option>48</option>
    <option>49</option>
    <option>50</option>

    </select>
</p>

<p>
    <input
        type="submit"
        class="btn btn-primary"
        value="Submit"
    >
</p>

</form>
</div>

</body>
</html>

