
<h1>{{ $title }} {{ $sub_title }}</h1>

<div class="menu-container">
    <ul>
        <li><a href="/" class="{{ ( $active == "home" )? "active" : "" }}">Home</a></li>
        <li><a href="/notes" class="{{ ( $active == "notes" )? "active" : "" }}">Notes</a></li>
        <li><a class="disabled">Contact</a></li>
    </ul>

    <div class="cleaner"></div>
</div>