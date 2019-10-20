<div style="width:100%;display: flex">
    <div style="flex: 1;">
        <div style="width:100%;display: flex">
            <div style="flex:1;">
                <canvas id="dimension-{{$data['user_id']}}" height="200px"></canvas>
            </div>
            <div style="flex:2;">

                <canvas id="skill-{{$data['user_id']}}" height="100px"></canvas>
            </div>
        </div>
        <div style="width:100%;margin-top: 20px;">
            <canvas id="tracking-{{$data['user_id']}}" height="50px"></canvas>
        </div>
    </div>
    {{--    <div style="flex: 1;display: flex"></div>--}}
</div>
<input id="dimension_data-{{$data['user_id']}}" hidden value="{{json_encode($data['dimensions'])}}"/>
<input id="tracking_data-{{$data['user_id']}}" hidden value="{{json_encode($data['trackings'])}}"/>
<input id="skill_data-{{$data['user_id']}}" hidden value="{{json_encode($data['skills'])}}"/>
<script>
    // 画维度雷达图
    $(function () {
        //获取图表的原始json string
        let ori = JSON.parse(document.getElementById("dimension_data-{{$data['user_id']}}").value);
        let ctx = document.getElementById("dimension-" + "{{$data['user_id']}}").getContext('2d');
        let labels = [];
        let data = [];
        for (let i = 0; i < ori.length; i++) {
            labels.push(ori[i]['name']);
            data.push(ori[i]['value']);
        }
        let myChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '维度',
                        data: data,
                        borderWidth: 1,
                        borderColor: 'rgba(0,123,255,0.5)',
                        backgroundColor: 'rgba(0,123,255,0.5)',
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: '各维度雷达图',
                        fontSize: 18
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 2
                        },
                        pointLabels: {
                            display: true,
                            fontSize: 14
                        }
                    },
                    legend: {
                        display: false,
                    }
                }
            })
        ;
    });

    //画维度追踪折线图
    $(function () {
        //获取图表的原始json string
        let ori = JSON.parse(document.getElementById("tracking_data-{{$data['user_id']}}").value);
        let ctx = document.getElementById("tracking-" + "{{$data['user_id']}}").getContext('2d');
        let labels = [];
        let maxLength = 0;
        let datasets = [];
        for (let i = 0; i < ori.length; i++) {
            if (ori[i].value.length >= maxLength) {
                maxLength = ori[i].value.length;
            }
            let dataset = {};
            dataset.label = ori[i].name;
            dataset.data = ori[i].value;
            let color = 'rgba(' + ori[i].color + ',0.7)';
            dataset.backgroundColor = color;
            dataset.borderColor = color;
            datasets.push(dataset);
        }
        for (let i = 0; i < datasets.length; i++) {
            datasets[i].fill = false;
            for (let n = 0; n < maxLength; n++) {
                if (datasets[i].data[n] === undefined) {
                    datasets[i].data[n] = datasets[i].data[n - 1];
                }
            }
        }
        let xLabels = [];
        for (let i = 0; i < maxLength; i++) {
            xLabels.push('第' + (i + 1) + '次记录');
        }
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                title: {
                    display: true,
                    text: '维度追溯曲线图',
                    fontSize: 18
                },
                scales: {
                    xAxes: [{
                        type: 'category',
                        labels: xLabels
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1,
                            max: 10,
                            beginAtZero: true
                        }
                    }]
                },
            }
        });
    });
    //画技能柱状图
    $(function () {
        //获取图表的原始json string
        let ori = JSON.parse(document.getElementById("skill_data-{{$data['user_id']}}").value);
        let ctx = document.getElementById("skill-" + "{{$data['user_id']}}").getContext('2d');
        let labels = [];
        let data = [];
        for (let i = 0; i < ori.length; i++) {
            labels.push(ori[i].name);
            data.push(ori[i].value);
        }
        let myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labels,
                datasets: [
                    {
                        borderWidth: 1,
                        data: data
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: '员工技能掌握图',
                    fontSize: 18
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            stepSize: 1,
                            max: 10,
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        barPercentage: 1
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    });

</script>
