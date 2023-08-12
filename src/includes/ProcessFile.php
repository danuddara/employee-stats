<?php
session_start();
require_once ('classes/DatabaseClass.php');
require_once ('classes/ModelClass.php');
require_once ('classes/Employee.php');
require_once ('classes/Session.php');

/**
 * The main controller for processing data
 */
class ProcessFile
{
    /**
     * @var string[]
     */
    private array $allowedFileTypes;
    private string $targetDir;
    private Session $session;
    /**
     * @var array|mixed
     */
    private mixed $flashMessages;
    private Employee $employee;
    /**
     * @var string[]
     */
    private array $columns;

    public function __construct()
    {
        $this->session = new Session();
        $this->allowedFileTypes = ['csv'];
        $this->targetDir = 'uploads';
        $this->flashMessages = $this->session->getFlashMessages();
        $this->columns = [
            'company_name',
            'employee',
            'email_address',
            'salary'
        ];
        $this->employee = new Employee('employee',$this->columns);

    }

    public function action(): void
    {
        if (isset($_POST['submit'])) {
            $this->process();
        } elseif (isset($_POST['save'])) {
            $this->updateEmployee();
        }
    }


    /**
     * @throws Exception
     */
    public function process(): void
    {
        if (isset($_POST["submit"])) {
            $filename = $_FILES["csv_file"]["name"];
            $tmpFile = $_FILES["csv_file"]["tmp_name"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array($ext,$this->allowedFileTypes)) {
                $data = $this->extractData($tmpFile);
                try {
                    $this->employee->create($data);
                    $this->session->setFlashMessage('success','Successfully extracted the data',);
                } catch (Exception $exception) {
                    $this->session->setFlashMessage('danger',$exception->getMessage());
                }

            } else {
                $this->session->setFlashMessage('warning','Sorry, Please upload a csv file to process data');
            }

           header('Location:../index.php');
        }
    }

    public function updateEmployee(): void
    {
        if (isset($_POST["save"]) && isset($_POST['email'])) {
            $email = $_POST['email'];
            $id = $_POST['id'];
            $updated = $this->employee->update(['email_address'=>$email],$id);
            if ($updated){
                $this->session->setFlashMessage('success','Successfully Updated the email',);
            } else{
                $this->session->setFlashMessage('warning','Sorry, something went wrong. Please try again');
            }
            header('Location:../index.php');
        }
    }


    protected function extractData($filePath): array
    {
        $array =[];
        if (($open = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $array[] = $data;
            }
            fclose($open);
        }
        //removes the header row
        array_shift($array);
        return $array;
    }

    public function getAlertMessages(): array
    {
        return $this->flashMessages;
    }

    public function getAllRecords(): bool|array
    {

        return $this->employee->findAll();
    }

    public function getAverageSalaryRecords(): bool|array
    {
        return $this->employee->getAverageSalaryByCompany();
    }

    public function getRecordsToDisplay(): array
    {
        $averageSalary = $this->getAverageSalaryRecords();
        $employeeRecords = $this->getAllRecords();
        $data = [];
        foreach ($averageSalary as $company){

               $employees = array_filter($employeeRecords,function ($employeeRecord) use ($company) {
                   return $employeeRecord['company_name'] === $company['company_name'];
               });
               $data[] = array_merge($company,['employees'=>array_values($employees),'count'=>count($employees)]);
        }

        return $data;

    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getEmployee($id,$column=null)
    {
        $employee = $this->employee->findOne($id);
        return $column ? $employee[$column] : $employee;

    }

}

