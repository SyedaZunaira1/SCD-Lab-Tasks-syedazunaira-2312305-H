<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info Table</title>
</head>
<body>
 
<div class="container">
     <h1>Student Information System</h1>

     <?php 
     function processStudent($student){

        $total=array_sum($student['marks']);

        $average = $total / count($student['marks']);
            $student['average'] = round($average, 1);

        if($average >= 80){
            $student['status']='Excelent';
        }
        elseif($average >=60){
            $student['status']='Good';
        }
        elseif($average >=40){
            $student['status']='Pass';
        }
        else{
            $student['status']='Fail';
        }
     

     switch($student['status']){
        case 'Excelent':
            $student['message']='Awarded ScholarShip';
            break;

        case 'Good':
            $student['message']='Can Apply for internship';
            break;
        
            case 'Pass':
                $student['message']='Need Improvement';
                break;

                case 'Fail':
                    $student['message']='Repeat Semester';
                    break;
                    default:
                    $student['message']='unknown';
                
     }
     return $student;
    
}
$student=[];

$student1=[
    'name' => 'Ali',
    'age' => '21',
    'marks' => explode(',','90,82,94,80,88'),
    'status'=>''
];

$student1=processStudent($student1);
$student[]=$student1;

$student2=[
    'name' => 'Ahmed',
    'age' => '23 Years',
    'marks' => explode(',','90,82,94,80,88'),
    'status'=>''
];

$student2['age'] = (int)$student2['age'];
$student2=processStudent($student2);
$student[]=$student2;

$student3=[
    'name'=>'Ayesha',
    'age'=>'13',
    'marks'=>explode(',', '30,80,89,79,99'),
    'status'=>''
];

$student3=processStudent($student3);
$student[]=$student3;

$student4=[
    'name' => 'Bilal',
    ' age' => '25 Years',
    'marks' => explode(',','80,72,84,50,68'),
    'status'=>''
];

$student4['age']=(int)$student2['age'];
$student4=processStudent($student4);
$student[]=$student4;

     
     ?>






    <table>
        <thead>
      <tr>
       <th> Name</th>
       <th> Age</th>
       <th> Mark</th>
       <th> Average</th>
       <th> Status</th>
       <th> Message</th>
      </tr>
      </thead>
      <tbody>
      
      <?php foreach ($student as $student): ?>
        <tr>

           <td> <?php echo htmlspecialchars($student['name']);?></td>
           <td> <?php echo $student['age']; ?></td>
           <td> <?php echo implode(', ', $student['marks']); ?></td>
           <td><?php echo $student['average']; ?></td>
           <td> <?php echo $student['status'];?></td>
           <td> <?php echo $student['message'];?></td>

           </tr>
           <?php endforeach; ?>
      </tbody>
</div>
    </table>
</body>

<style>
    body{
        background-color: #303b36ff;
        padding: 50px auto;
        text-align: center;
    }
    .container{
        background: #ffffffff;
       padding: 20px;
    margin: 20px auto;
    max-width: 1200px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
          th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            font-weight: bold;
        }
       
</style>
</html>