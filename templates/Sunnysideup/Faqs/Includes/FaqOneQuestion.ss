<% if $Content %>
<li class="$FirstLast faq-one">
    <h2 class="faq-question" id="question-{$URLSegment}-{$ID}"><a href="$Link">$Title</a></h2>
    <div class="faq-answer" id="answer-{$URLSegment}-{$ID}">$Content</div>
</li>
<% end_if %>
