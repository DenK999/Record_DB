<div style="text-align:center; margin-top:2em;">
{% if timeGenerateFile is defined %}
    <p>Generate File: <strong>{{timeGenerateFile}}</strong> sec.</p>
{% endif %}

{% if timeCopyRecords is defined %}
    <p>Copy Record to DB: <strong>{{timeCopyRecords}}</strong> sec.<p>
{% endif %}

{% if mainTime is defined %}
    <h1>Main time of work app: {{ mainTime }} </h1>
{% endif %}
</div>