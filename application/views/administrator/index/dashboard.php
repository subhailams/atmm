<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <th> <?= $this->lang->line('dashboard') ?></th>
            <small> <?= $this->lang->line('control_panel') ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('dashboard') ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $usercount ?></h3>
                        <p><?= $this->lang->line('total_users') ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                    <a href="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/showallusers") ?>" class="small-box-footer"><?= $this->lang->line('more_info') ?> <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $casecount ?></h3>
                        <p><?= $this->lang->line('total_cases') ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                    <a href="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/cases/allcases") ?>" class="small-box-footer"><?= $this->lang->line('more_info') ?> <i
                            class="fa fa-arrow-circle-right"></i></a>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $solvedcount ?></h3>
                        <p><?= $this->lang->line('solved_cases') ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/cases/allsolvedcases") ?>" class="small-box-footer"> <?= $this->lang->line('more_info') ?><i
                            class="fa fa-arrow-circle-right"></i></a>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $pendingcount ?></h3>

                        <p><?= $this->lang->line('pending_cases') ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/cases/allpendingcases") ?>" class="small-box-footer"><?= $this->lang->line('more_info') ?><i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b><?= $this->lang->line('offencereport') ?></b></h3>
                    </div>
                    <div align="center" class="divC"><img width="732" height="568" border="0"
                                                          src="<?= $this->lang->line('map') ?>"
                                                          usemap="#Map" alt="Maharashtra Map">
                        <map name="Map" id="map">
                            <area href="#" coords="165,240" alt="Maharashtra Map" shape="poly">
                            <area  
                                href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/32") ?>"
                                coords="165,237,157,228,151,221,142,209,136,209,130,211,123,217,117,224,112,224,110,220,106,225,103,236,103,232,103,236,91,237,96,240,103,242,111,247,115,256,126,259,137,256,144,255,155,250,165,238"
                                target="_blank" alt="Thane" shape="poly">
                            <area 
                                href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/1") ?>"
                                coords="310,292,298,289,296,282,292,285,281,287,274,294,260,283,249,274,247,269,258,268,255,260,287,268,279,260,296,259,295,252,301,244,302,237,289,230,268,221,254,217,243,215,238,209,232,205,232,198,233,192,218,191,206,191,204,194,210,203,199,210,193,217,187,216,176,214,173,208,168,217,157,220,153,221,167,237,182,241,188,249,202,249,202,254,196,262,203,271,218,288,225,298,231,313,240,312,245,316,248,321,262,316,269,311,277,305,287,305,296,304,303,298,310,293"
                                target="_blank" alt="Ahmadnagar" shape="poly">
                            <area 
                                href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/25") ?>"
                                coords="261,352,268,344,268,338,264,333,253,329,246,327,246,322,242,317,237,314,232,316,225,300,219,298,216,289,205,276,197,265,197,258,199,251,187,250,181,244,174,240,168,241,160,248,151,255,145,260,137,273,131,287,129,297,130,304,135,310,138,321,147,330,154,334,152,342,162,344,171,340,174,332,186,335,202,339,222,343,237,345,251,351,261,352"
                                target="_blank" alt="Pune" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/29") ?>"
                                  coords="251,379,249,369,241,367,235,362,230,361,229,357,232,351,235,347,219,344,203,341,188,338,179,335,174,337,170,345,162,345,153,345,147,352,147,359,145,368,156,375,157,381,157,388,160,392,156,395,153,403,156,407,159,404,164,407,170,412,179,417,185,419,192,418,198,415,200,408,202,402,201,397,201,393,207,394,219,396,224,393,228,391,233,392,235,386,243,388,249,387,251,380"
                                  target="_blank" alt="Satara" shape="poly">
                            <area href="#" coords="242,425" alt="Sangli" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/28") ?>"
                                  coords="251,447,236,450,226,444,217,438,212,436,206,433,194,433,187,433,180,425,165,415,156,413,159,408,176,418,187,421,196,418,201,410,204,401,204,396,215,398,227,396,236,393,247,391,252,384,256,384,255,394,263,392,256,404,250,411,253,417,261,415,271,410,280,409,281,414,284,418,288,415,295,415,300,411,307,407,311,419,313,428,303,432,288,432,281,436,276,442,269,435,259,433,253,433,252,439,250,447"
                                  target="_blank" alt="Sangli" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/15") ?>"
                                  coords="190,523,183,524,184,520,185,505,168,499,168,501,166,495,176,492,170,481,167,473,154,468,156,459,164,456,167,444,161,438,163,434,167,428,165,420,170,421,181,432,192,436,205,436,212,439,219,442,225,447,230,451,227,456,230,461,222,458,217,457,206,459,199,461,200,468,205,471,206,479,210,484,215,488,216,495,205,496,205,501,213,503,210,511,203,516,204,524,196,521,190,523"
                                  target="_blank" alt="Kolhapur" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/31") ?>"
                                  coords="370,402,367,397,365,392,368,388,367,383,372,382,374,378,367,373,360,372,352,370,347,367,339,366,339,361,333,362,326,355,329,344,338,348,337,341,336,335,336,327,345,318,344,315,335,320,324,319,318,315,317,320,312,326,306,332,304,335,296,335,293,330,288,322,284,315,283,310,278,308,270,314,258,319,250,324,249,325,269,334,272,340,271,347,265,351,264,356,253,355,244,350,239,348,234,353,233,358,240,363,249,367,252,371,254,378,258,383,258,390,265,390,264,396,256,407,254,411,257,413,265,409,274,407,281,405,284,409,285,414,292,412,297,409,304,407,304,402,307,397,308,392,313,391,320,396,325,399,329,394,336,403,345,401,352,398,362,400,370,402"
                                  target="_blank" alt="Solapur" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/18") ?>"
                                  coords="94,253,91,248,92,243,96,242,103,243,106,247,111,250,114,256,95,255"
                                  target="_blank" alt="Mumbai Suburban" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/17") ?>"
                                  coords="94,273,94,267,96,264,97,262,96,258,98,257,104,257,113,257,110,261,104,266,101,271,95,272,93,274"
                                  target="_blank" alt="Mumbai City" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/26") ?>"
                                  coords="143,257,139,267,133,275,130,283,127,288,129,292,128,297,128,306,134,311,135,318,142,326,147,331,151,335,149,340,152,342,149,348,145,352,142,355,136,356,130,354,130,348,126,343,118,342,112,345,109,341,108,333,105,326,114,331,115,324,109,322,104,316,102,311,103,305,105,302,101,297,99,292,98,287,100,282,104,282,109,284,114,283,113,280,108,279,106,277,102,275,106,271,112,268,116,266,116,263,110,263,116,259,124,259,133,259,143,257"
                                  target="_blank" alt="Raigad" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/27") ?>"
                                  coords="113,350,116,359,120,366,118,372,121,379,121,382,123,393,125,403,131,422,131,436,132,450,136,457,144,461,152,458,157,456,161,454,165,446,160,445,160,439,160,433,165,429,164,420,157,416,155,409,153,399,153,395,157,390,156,382,154,376,147,371,143,365,144,360,138,358,132,358,128,356,127,350,125,345,119,343,113,347"
                                  target="_blank" alt="Ratnagiri" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/30") ?>"
                                  coords="133,459,134,466,138,473,140,481,141,487,143,498,147,509,154,515,159,522,169,519,174,523,175,530,179,533,184,531,181,529,179,525,179,521,183,519,183,510,180,505,174,501,168,502,164,499,165,494,170,493,173,492,169,488,166,483,165,481,164,476,159,474,152,469,153,463,148,463,141,462,133,459"
                                  target="_blank" alt="Sindhudurg" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/21") ?>"
                                  coords="220,27,213,30,211,34,206,34,200,34,191,35,184,38,173,39,176,43,179,47,180,52,180,57,172,56,175,60,177,66,185,64,196,61,202,62,209,61,213,64,211,68,202,70,193,71,187,73,185,81,181,86,175,87,173,93,165,95,158,94,168,100,175,101,179,107,187,101,189,98,189,93,195,92,207,92,220,91,218,86,217,84,220,79,228,75,234,76,239,76,243,71,245,65,245,61,238,59,232,58,227,58,231,56,222,51,225,43,225,35,221,27"
                                  target="_blank" alt="Nadurbar" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/9") ?>"
                                  coords="249,60,247,66,244,73,240,79,233,78,229,77,222,80,219,84,222,88,223,91,217,93,202,94,193,94,191,99,187,104,180,109,180,113,181,116,182,119,184,123,191,121,200,121,211,122,217,124,221,126,225,125,231,126,235,128,238,132,239,135,244,136,249,138,252,137,258,135,261,130,260,123,256,117,255,111,254,104,256,99,261,94,267,89,273,86,274,82,274,78,275,76,270,71,268,66,261,62,255,60,249,59"
                                  target="_blank" alt="Dhule" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/22") ?>"
                                  coords="184,124,182,129,174,132,175,135,171,142,164,142,159,143,155,139,145,134,142,134,142,138,145,139,145,144,141,154,139,156,141,162,141,169,137,173,129,173,125,180,133,184,138,185,138,192,138,199,141,203,143,207,146,212,151,218,157,219,165,216,167,212,171,206,175,205,176,210,179,212,186,214,192,215,194,212,200,207,206,204,207,202,203,196,202,192,204,189,212,190,223,190,231,190,235,191,235,194,235,199,234,202,237,199,239,193,240,189,242,186,241,175,249,171,253,173,257,177,251,162,246,154,246,150,248,143,248,140,238,138,236,133,233,129,225,127,216,126,207,124,197,123,184,123"
                                  target="_blank" alt="Nashik" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/13") ?>"
                                  coords="353,96,351,90,348,84,342,83,336,80,323,81,312,81,301,81,296,80,286,78,278,78,277,80,275,86,269,91,260,97,257,103,257,110,257,114,260,119,262,126,262,132,259,137,254,140,250,141,249,147,248,152,249,156,251,160,254,166,256,169,258,169,263,164,266,166,270,165,272,160,274,155,279,150,284,146,288,145,293,145,294,147,296,150,298,147,301,147,304,147,305,143,309,143,317,138,321,141,324,145,328,146,330,142,332,142,333,146,335,146,337,143,341,141,343,140,341,133,339,130,343,127,346,122,347,116,352,112,357,108,360,108,365,110,369,113,371,109,370,107,364,105,358,105,353,104,349,102,351,97"
                                  target="_blank" alt="Jalgaon" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/4") ?>"
                                  coords="331,158,332,152,333,148,332,144,329,147,324,147,318,142,314,142,309,144,306,147,303,149,299,150,295,151,291,147,285,147,280,153,275,159,271,166,266,168,261,170,259,174,259,178,255,177,251,173,247,174,244,177,244,183,243,187,241,191,240,195,238,200,236,203,238,205,241,210,245,210,245,214,256,216,264,218,271,219,276,222,282,226,289,227,293,230,302,235,305,238,310,238,313,235,312,227,312,217,313,206,318,197,320,189,321,181,322,172,323,165,330,159"
                                  target="_blank" alt="Aurangabad" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/14") ?>"
                                  coords="343,142,338,145,336,148,335,151,334,154,332,160,328,163,326,168,323,180,323,187,321,195,318,203,315,210,314,218,314,223,314,228,315,232,315,237,312,240,317,242,322,238,328,238,333,238,336,240,334,243,338,246,341,243,345,243,346,247,349,244,354,244,355,239,356,234,356,227,354,221,354,216,355,214,360,217,359,212,359,209,366,209,366,204,367,202,362,202,356,204,351,203,349,199,343,195,340,191,343,187,346,182,349,177,352,174,353,170,349,167,346,168,336,168,333,164,333,160,336,155,338,151,341,147,343,143"
                                  target="_blank" alt="Jalna" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/6") ?>"
                                  coords="394,287,390,281,385,278,380,275,376,269,372,263,368,263,365,263,367,258,368,252,361,250,354,249,348,249,341,247,335,248,332,246,332,241,326,241,321,243,315,244,307,241,304,242,300,248,297,253,300,257,300,261,293,262,286,262,290,265,290,269,285,270,278,268,272,266,266,264,261,263,258,262,260,268,258,272,253,271,250,271,254,276,260,281,266,285,272,289,274,287,279,285,285,284,290,283,292,280,297,282,300,287,303,287,308,288,313,292,320,294,328,294,334,296,340,298,348,299,353,299,355,302,360,300,365,302,373,303,378,306,383,307,387,308,389,305,393,306,391,302,392,296,395,291,394,287"
                                  target="_blank" alt="Beed" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/23") ?>"
                                  coords="394,375,396,370,399,366,400,362,398,360,399,357,396,354,384,348,376,346,371,345,365,340,363,337,365,329,365,325,364,318,360,315,362,310,366,308,370,306,362,304,357,304,353,304,349,302,343,303,337,301,332,298,327,297,322,296,319,297,314,297,310,296,306,298,302,302,298,305,294,307,290,307,286,309,286,313,290,318,293,323,295,328,297,332,302,332,305,327,309,325,312,320,316,320,316,315,318,311,323,315,327,317,331,318,334,318,337,316,341,314,345,313,347,315,346,319,344,323,340,326,339,330,340,333,339,337,340,340,341,343,341,349,338,350,333,349,331,347,330,351,331,355,333,358,336,358,340,358,343,359,342,363,345,364,349,364,354,365,354,368,357,369,361,369,365,367,368,370,372,372,376,375,379,374,381,370,384,366,388,367,391,370,394,374,390,371,394,375"
                                  target="_blank" alt="Usmanabad" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/16") ?>"
                                  coords="433,330,435,324,436,319,442,315,445,313,443,311,438,307,440,301,436,297,431,297,431,293,433,290,427,291,422,291,421,287,417,283,412,282,409,283,403,284,400,288,397,293,394,296,394,302,396,304,396,309,393,309,389,310,380,310,375,307,371,307,369,310,364,312,365,316,367,321,368,326,367,331,367,337,369,340,375,344,381,344,387,347,394,351,400,354,404,359,406,357,412,356,412,352,412,348,415,344,412,339,414,335,417,334,421,336,426,335,427,332,433,330"
                                  target="_blank" alt="Latur" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/20") ?>"
                                  coords="478,304,476,299,478,295,482,293,485,286,488,284,495,284,492,279,487,279,483,274,478,273,478,266,485,260,487,253,489,248,490,242,500,245,504,250,511,248,512,241,513,236,519,233,521,227,521,222,522,216,524,211,527,206,523,201,519,201,513,200,507,200,502,199,494,201,490,205,492,210,498,212,504,213,510,214,514,215,515,216,516,220,514,224,511,228,508,231,502,232,497,233,491,230,489,233,485,236,477,237,475,234,478,230,478,227,475,225,472,222,472,218,467,217,461,214,462,219,462,226,461,230,456,232,456,236,452,238,449,240,445,238,440,244,437,247,435,254,433,259,428,262,425,265,424,271,420,274,424,275,421,281,423,285,424,289,434,288,438,289,434,294,440,295,443,298,444,301,441,307,444,309,448,308,449,311,450,315,449,322,456,323,455,327,458,327,460,322,463,325,464,323,461,319,463,314,466,310,468,305,472,303,479,305"
                                  target="_blank" alt="Nanded" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/12") ?>"
                                  coords="459,214,453,209,453,205,449,201,444,197,439,194,435,195,424,190,418,191,412,193,409,193,403,198,397,202,395,204,397,209,400,211,409,212,411,212,412,220,408,225,402,233,402,236,404,240,407,245,408,253,409,261,411,268,413,272,419,270,422,267,423,260,428,259,432,256,432,251,435,244,440,239,447,235,452,236,454,231,459,228,459,222,459,213"
                                  target="_blank" alt="Hingoli" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/24") ?>"
                                  coords="409,216,404,215,397,213,394,209,393,203,389,203,383,201,381,196,376,199,372,201,368,210,362,212,363,215,361,220,358,223,359,229,359,234,358,240,358,245,363,247,368,248,372,251,371,256,369,260,373,260,377,264,378,270,381,273,385,273,387,277,391,277,393,282,397,285,401,282,408,281,411,280,418,280,420,275,413,274,409,270,406,261,404,252,404,246,400,240,400,234,401,229,406,224,409,220,409,216"
                                  target="_blank" alt="Parbhani" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/35") ?>"
                                  coords="525,197,533,204,547,204,558,207,568,208,572,208,574,206,587,200,584,197,581,186,575,179,569,173,557,168,552,163,546,157,541,157,537,152,526,151,519,145,518,139,513,139,508,139,502,144,499,147,496,143,490,148,488,149,478,146,477,149,476,153,471,159,471,165,476,168,475,173,476,176,475,181,472,186,467,185,463,183,458,183,452,182,452,186,451,191,448,194,451,198,454,202,455,206,458,209,464,212,470,215,474,217,476,223,480,224,482,227,483,232,478,233,483,235,487,232,490,227,494,228,500,231,505,230,509,226,514,222,510,218,497,217,490,214,487,209,486,203,488,200,496,197,504,197,511,197,518,197,520,198,524,197"
                                  target="_blank" alt="Yavatmal" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/34") ?>"
                                  coords="472,131,469,140,461,140,444,139,441,142,442,149,440,158,437,159,430,154,425,154,423,158,415,161,407,170,404,174,407,176,404,180,395,184,396,187,398,191,395,196,396,200,405,192,410,190,419,189,424,187,431,192,435,194,440,190,444,194,447,191,449,185,449,180,452,179,458,181,463,181,469,183,472,181,474,176,471,173,472,169,469,165,468,159,471,155,474,150,474,145,474,137,472,131"
                                  target="_blank" alt="Washim" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/7") ?>"
                                  coords="397,89,393,94,391,98,386,102,380,102,375,104,373,109,372,114,366,114,361,112,358,111,353,112,349,117,348,123,343,129,343,135,344,141,345,145,342,150,338,155,336,161,337,166,342,166,346,164,352,165,355,168,355,174,350,181,346,187,343,191,347,194,350,196,351,200,356,201,362,199,367,199,372,196,378,194,382,195,384,199,389,201,393,200,393,195,396,191,394,187,391,183,395,180,400,178,403,177,403,173,403,170,399,165,396,161,396,156,396,151,399,148,400,144,398,138,396,134,399,130,398,126,397,123,398,118,401,114,401,106,401,99,401,94,398,89"
                                  target="_blank" alt="Buldhana" shape="poly">
                            <area hhref="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/2") ?>"
                                  coords="468,137,471,130,467,125,461,123,453,123,448,124,440,124,436,122,433,116,434,111,432,108,435,103,436,98,437,93,432,94,424,93,421,96,415,97,404,96,405,99,403,108,404,114,402,118,400,122,401,125,402,129,399,135,401,140,403,143,401,148,398,153,398,159,401,163,404,167,408,164,414,159,419,156,422,152,427,152,433,152,437,155,440,153,439,146,439,140,443,137,454,137,460,138,467,137"
                                  target="_blank" alt="Akola" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/3") ?>"
                                  coords="463,60,460,54,455,50,447,51,442,52,441,54,435,55,430,54,423,55,416,61,406,63,401,70,398,76,396,82,392,85,398,87,402,91,408,93,416,93,421,92,428,90,434,91,439,91,439,94,438,100,437,105,437,109,437,113,437,118,442,121,447,121,456,120,462,120,468,123,471,127,476,131,477,137,476,142,479,143,486,146,491,144,494,141,499,142,502,139,507,135,513,136,519,133,520,126,512,118,509,110,508,104,505,97,503,92,501,87,500,82,504,81,510,81,516,81,522,80,530,78,533,75,530,72,530,66,530,61,524,64,516,65,513,66,511,71,502,75,496,77,492,79,485,79,478,82,472,81,466,81,463,79,460,80,455,78,455,73,452,68,455,65,461,66,467,67,463,59"
                                  target="_blank" alt="Amaravati" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/19") ?>"
                                  coords="616,58,609,56,596,54,595,57,587,60,576,62,570,64,572,72,563,72,550,74,542,72,538,71,533,78,522,82,526,87,537,92,545,99,553,105,563,116,573,124,584,130,594,137,597,140,602,138,606,134,609,131,613,134,618,129,620,120,624,117,625,109,622,102,620,94,621,87,620,80,615,76,613,71,616,64,617,58"
                                  target="_blank" alt="Nagpur" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/33") ?>"
                                  coords="556,112,551,107,544,102,537,95,529,92,523,87,516,83,506,83,502,84,506,94,509,99,511,108,515,117,519,123,522,127,521,139,526,147,535,149,541,152,548,156,552,162,558,165,563,167,565,160,567,154,571,155,578,153,582,149,588,151,593,147,597,143,590,137,576,129,567,124,563,120,557,114"
                                  target="_blank" alt="Wardha" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/5") ?>"
                                  coords="650,65,642,65,638,62,633,61,629,64,619,66,616,69,615,72,619,75,623,79,623,85,622,92,623,98,625,104,627,107,627,115,625,119,622,123,621,128,624,130,629,132,632,133,636,130,641,130,645,130,649,132,647,126,645,121,641,116,642,113,647,112,651,108,654,106,659,104,661,100,659,93,656,88,653,85,648,80,644,78,643,74,647,69,649,65"
                                  target="_blank" alt="Bhandara" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/11") ?>"
                                  coords="706,82,701,81,697,78,690,75,686,74,683,66,677,61,671,57,664,61,654,64,649,71,645,75,651,80,657,85,661,92,663,98,663,103,657,108,650,113,645,115,647,119,649,125,651,131,656,130,659,129,665,131,676,131,680,128,682,122,682,118,686,119,691,117,697,117,697,113,691,110,685,106,685,101,688,94,693,92,699,90,704,86,706,82"
                                  target="_blank" alt="Gondia" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/8") ?>"
                                  coords="650,228,650,222,649,216,649,208,647,201,647,194,653,194,653,191,648,183,648,176,650,168,650,162,651,154,650,148,648,144,649,137,645,133,638,133,634,136,628,135,622,132,616,134,612,135,607,139,601,143,596,148,590,153,584,153,579,155,574,158,569,158,568,161,566,166,568,169,576,174,577,179,582,182,585,186,585,192,590,198,591,201,582,206,576,208,571,212,567,213,574,215,576,218,573,224,580,223,588,228,593,231,595,226,596,219,598,216,603,221,609,222,617,226,624,226,631,222,637,219,644,223,649,227"
                                  target="_blank" alt="Chandrapur" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/10") ?>"
                                  coords="701,132,697,119,683,121,682,126,678,131,670,132,660,132,654,132,649,133,650,136,650,143,651,148,651,156,652,165,651,174,650,180,654,186,655,191,652,196,648,196,650,205,650,213,651,223,653,229,657,231,657,239,653,249,655,253,649,260,650,264,654,265,655,274,654,281,659,283,667,290,676,290,678,285,684,282,681,274,679,267,683,260,685,252,690,245,695,239,704,235,709,238,714,241,715,244,724,236,719,232,721,229,727,228,728,225,724,222,710,218,708,205,700,205,691,203,690,190,700,187,695,175,690,169,704,160,704,139,694,138"
                                  target="_blank" alt="Gadchiroli" shape="poly">
                            <area href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/districtcases/24") ?>"
                                  coords="99,172,105,169,105,178,111,183,117,182,122,182,129,185,136,188,135,196,138,204,130,207,127,209,125,213,121,213,118,218,112,221,109,219,105,221,104,228,102,232,99,235,90,234,90,227,88,219,87,212,87,203,85,197,85,191,88,189,88,184,89,174,93,173,98,173,95,171,96,172"
                                  target="_blank" alt="Palghar" shape="poly">
                        </map>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--            <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">New Cases</a>
                                    </li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pending Cases</a></li>
                                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Solved Cases</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <br/>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>FIR No</th>
                                                    <th>Case Victim Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php foreach ($newcase as $new): ?>
                                                            <tr>
                                                                <td><?= $new['FIR'] ?> </td>
                                                                <td><?= $new['VictimName'] ?></td>
                                                                <td><?= $new['VictimMobile'] ?></td>
                                                                <td><span class="label label-info">Filed</span></td>
                                                            </tr>
                                                            </div>
            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
            
                                    <div class="tab-pane" id="tab_2">
                                        <br/>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>FIR No</th>
                                                    <th>Case Victim Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php foreach ($pendingcase as $pending): ?>
                                                            <tr>
                                                                <td><?= $pending['FIR'] ?> </td>
                                                                <td><?= $pending['VictimName'] ?></td>
                                                                <td><?= $pending['VictimMobile'] ?></td>
                                                                <td><span class="label label-info">Police Tracking</span></td>
                                                            </tr>
                                                            </div>
            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
            
                                    <div class="tab-pane" id="tab_3">
                                        <br/>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>FIR No</th>
                                                    <th>Case Victim Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php foreach ($solvedcase as $solved): ?>
                                                            <tr>
                                                                <td><?= $solved['FIR'] ?> </td>
                                                                <td><?= $solved['VictimName'] ?></td>
                                                                <td><?= $solved['VictimMobile'] ?></td>
                                                                <td><span class="label label-info">Solved</span></td>
                                                            </tr>
                                                            </div>
            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
            
                                </div>
            
                            </div>
            
                        </div>
                    </div>
                     /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>
