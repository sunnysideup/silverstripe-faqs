<h1>$Title</h1>
$Content
<% if $Entries %>
<ul id="FAQs">
<% loop $Entries %>
    <% include Sunnysideup\Faqs\Includes\FaqOneQuestion %>
<% end_loop %>
</ul>
<% end_if %>
$Form
