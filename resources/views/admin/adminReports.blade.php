@extends('layouts/adminLayout')

@section('title')
adminPage
@endsection

@section('content')
<div>
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full">
          <thead class="border-b">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Total earn
              </th>

              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
               last year earn
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
              last Month earn
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
              last week earn
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{$data['allTimeEarn']}} t
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$data['lastYearEarn']}} t
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$data['lastMonthEarn']}} t 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$data['lastWeekEarn']}} t 
              </td>
            </tr>
        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</div>


<div class="shadow-lg rounded-lg overflow-hidden h-3/4">
  <div class="py-3 px-5 bg-gray-50">last week</div>
  <canvas class="p-10" id="chartLine"></canvas>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart line -->
<script>
  const labels = ["7DayAgo", "6DayAgo", "5DayAgo", "4DayAgo", "3DayAgo", "2dayAgo",'yesterday'];
  const data = {
    labels: labels,
    datasets: [
      {
        label: "Last week earns",
        backgroundColor: "hsl(252, 82.9%, 67.8%)",
        borderColor: "hsl(252, 82.9%, 67.8%)",
        data: [{{$data['sevenDayAgoEarn']}}, {{$data['sixDayAgoEarn']}}, {{$data['fiveDayAgoEarn']}},{{$data['fourDayAgoEarn']}} ,{{$data['threeDayAgoEarn']}}, {{$data['twoDayAgoEarn']}}, {{$data['yesterdayEarn']}}],
      },
    ],
  };

  const configLineChart = {
    type: "line",
    data,
    options: {},
  };

  var chartLine = new Chart(
    document.getElementById("chartLine"),
    configLineChart
  );
</script>



@endsection
