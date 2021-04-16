<?php


class UserView
{
    private $pageContents;
    private $users;
    private $typeToArray;

    public function __construct($pageContents, $users, $TypeToArray)
    {
        $this->pageContents = $pageContents;
        $this->users = $users;
        $this->typeToArray = $TypeToArray;
    }

    public function showHeader()
    {
        echo "<!DOCTYPE html>
        <html lang=\"ar\" dir=\"rtl\">
        <head>";

        echo $this->pageContents[1][2];
        echo "قائمة المستخدمين";
        echo $this->pageContents[2][2];

        echo "</head>
    <body dir=\"rtl\">";

        echo $this->pageContents[3][2];


        echo "<main style=\"background-color: black;\">";
        echo $this->pageContents[4][2];

        if (isset($_SESSION["errorMessage"])) {
            echo "<div class=\"alert alert-danger justify-content-end d-flex\" role=\"alert\" data-mdb-color=\"danger\" dir=\"rtl\">";
            echo $_SESSION["errorMessage"];
            echo "</div>";
            unset($_SESSION["errorMessage"]);
        }
        if (isset($_SESSION["successMessage"])) {
            echo "<div class=\"alert alert-success justify-content-end d-flex\" role=\"alert\" data-mdb-color=\"danger\" dir=\"rtl\">";
            echo $_SESSION["successMessage"];
            echo "</div>";
            unset($_SESSION["successMessage"]);
        }
    }

    public function showUsers()
    {
        echo "<div class=\"container\">
        <h1 class=\"text-white text-center\">  قائمة المستخدمين </h1>
        <div  class=\"row\" style=\"padding-top: 10%; padding-bottom: 10%\">
            <table class=\"table col-12\" dir=\"rtl\">
                <thead >
                <tr class=\"table-dark\">
                    <th scope=\"col\">كود</th>
                    <th scope=\"col\">الإسم</th>
                    <th scope=\"col\">الوظيفة</th>
                    <th scope=\"col\">إسم المستخدم</th>
                    <th scope=\"col\">كلمة السر</th>
                    <th scope=\"col\">تاريخ التسجيل</th>
                    <th scope=\"col\">آخر تسجيل دخول</th>
                    <th scope=\"col\">حذف</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($this->users as $record) {
            echo "<tr class='table-light'>";
            echo "<td>" . $record['id'] . "</td>";
            echo "<td>" . $record['name'] . "</td>";
            echo "<td>" . $this->typeToArray[$record['type']] . "</td>";
            echo "<td>" . $record['userName'] . "</td>";
            echo "<td>" . $record['password'] . "</td>";
            echo "<td>" . $record['regesterationDate'] . "</td>";
            echo "<td>" . $record['LastSignIn'] . "</td>";
            echo "<td><a href='./DeleteUserPage.php?userId=" . $record['id'] . "'><button type='button' class='btn btn-danger'>حذف</button></a></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div></div>";
    }

    public function showAddUser()
    {
        echo "    <h2 class=\"text-white text-center\" style=\"padding-top: 10px \">  إضافة مستخدم جديد </h2>

    <form  style=\"padding-top: 5%; padding-bottom: 5%\" action=\"./AddUserValidation.php\" method=\"post\" name=\"form_submitted\">
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
            <div class=\"row\" >
                <label  class=\"label col-4\"  ><h4 class=\"text-white\">الإسم:</h4></label>
                <input type=\"text\" class=\"col-6\"  name=\"name\" id=\"name\" style=\"width: 400px\"  required />
            </div>
            </div>
        </div>
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
                <div class=\"row\" >
                    <label  class=\"label col-4\"  ><h4 class=\"text-white\">الرقم القومي:</h4></label>
                    <input type=\"number\" class=\"col-6\"  name=\"id\" id=\"id\" style=\"width: 400px\"  required />
                </div>
            </div>
        </div>
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
            <div class=\"row\" >
                <label  class=\"label col-4\"  ><h4 class=\"text-white\">إسم المستخدم:</h4></label>
                <input type=\"text\" class=\"col-6\"  name=\"userName\" id=\"userName\" style=\"width: 400px\"  required />
            </div>
            </div>
        </div>
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
                <div class=\"row\" >
                    <label class=\"label col-4\"  ><h4 class=\"text-white\">الوظيفة:</h4></label>
                    <select name=\"type\" id=\"type\" style=\"width: 100px\" required>
                        <option value=1>أدمن</option>
                        <option value=2>محاسب</option>
                    </select>
                </div>
            </div>
        </div>
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
            <div class=\"row\" >
                <label  class=\"label col-4\"  ><h4 class=\"text-white\">كلمة السر:</h4></label>
                <input type=\"password\" class=\"col-6\"  name=\"password\" id=\"password\" style=\"width: 400px\"  required />
            </div>
            </div>
        </div>
        <div class=\" d-flex justify-content-center\" style=\"padding: 2%\">
            <div class=\"container\">
            <div class=\"row\" >
                <label  class=\"label col-4\"  ><h4 class=\"text-white\">تأكيد كلمة السر:</h4></label>
                <input type=\"password\" class=\"col-6\"  name=\"password2\" id=\"password2\" style=\"width: 400px\"  required />
            </div>
            </div>
        </div>


        <!--Grid row-->

        <!--Grid row-->
        <div class=\"row d-flex justify-content-center\" style=\"padding-top: 60px\">
            <!--Grid column-->
            <button class=\"btn btn-primary\" name=\"submit\" type=\"submit\" value=\"Submit\">إضافة مستخدم جديد</button>
            <!--Grid column-->
        </div>
    </form>";
    }

    public function showFooter() {
    echo "</main>";
    echo $this->pageContents[0][2];
    echo "</body></html>";
    }
}