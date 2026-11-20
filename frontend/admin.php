<?php
session_start();
require '../config/config.php';

if (($_SESSION['user_type'] ?? '') !== 'admin') {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | JABA</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <link rel="stylesheet" href="design/css/adminstyle.css">
  <link rel="stylesheet" href="design/css/admin.css">
</head>
<body class="dashboard-view">
<div class="layout">
  <div id="menu"></div>

  <div class="main">
    <header class="topbar">
      <div class="tabs">
        <span class="lead">Overview</span>
      </div>
      <div class="user"><div class="avatar-sm">AD</div><div><b>System Admin</b>Payroll Manager</div></div>
    </header>

    <main class="content">
      <div class="page-head">
        <div>
          <h1>Dashboard</h1>
          <p>Pay Period: Nov 1 – Nov 15, 2026 • Next Payout in 3 days</p>
        </div>
        <div class="actions">
          <button class="btn">Export Summary</button>
          <button class="btn primary">+ Run Payroll</button>
        </div>
      </div>

      <section class="stats">
        <div class="card stat">
          <div class="stat-top"><span>Total Active Employees</span><span class="badge green">+2 this month</span></div>
          <div class="stat-num">32</div>
          <div class="stat-foot"><span>28 Active • 4 Inactive</span><a href="employees.html"><b>View all →</b></a></div>
        </div>
        <div class="card stat">
          <div class="stat-top"><span>Estimated Net Payroll</span><span class="badge">Current Cycle</span></div>
          <div class="stat-num">₱482,650.00</div>
          <div class="stat-foot"><span>Gross: ₱540,200.00</span><span>32 Payslips</span></div>
        </div>
        <div class="card stat">
          <div class="stat-top"><span>Attendance Rate</span><span class="badge green">96.8%</span></div>
          <div class="stat-num">31 / 32</div>
          <div class="stat-foot"><span>1 Approved Leave</span><span>0 Late</span></div>
        </div>
        <div class="card stat">
          <div class="stat-top"><span>Pending Requests</span><span class="badge amber">Action Needed</span></div>
          <div class="stat-num">4</div>
          <div class="stat-foot"><span>2 Leaves • 2 Advances</span><a href="#"><b>Review →</b></a></div>
        </div>
      </section>

      <section class="grid">
        <div class="card panel">
          <div class="panel-head">
            <div><h2>Recent Payroll Runs</h2><p>Completed and scheduled salary disbursements</p></div>
            <a href="payrollhistory.html" class="link">Payroll History →</a>
          </div>
          <table>
            <thead><tr><th>PAY PERIOD</th><th>EMPLOYEES</th><th>TOTAL DISBURSED</th><th>STATUS</th></tr></thead>
            <tbody>
              <tr><td><b>Nov 1 – Nov 15, 2026</b><small>Cutoff: Nov 15, 2026</small></td><td>32 Staff</td><td><b>₱482,650.00</b></td><td><span class="badge amber">Processing</span></td></tr>
              <tr><td><b>Oct 16 – Oct 31, 2026</b><small>Paid Oct 30, 2026</small></td><td>32 Staff</td><td><b>₱479,120.00</b></td><td><span class="badge green">Completed</span></td></tr>
              <tr><td><b>Oct 1 – Oct 15, 2026</b><small>Paid Oct 15, 2026</small></td><td>30 Staff</td><td><b>₱451,800.00</b></td><td><span class="badge green">Completed</span></td></tr>
              <tr><td><b>Sep 16 – Sep 30, 2026</b><small>Paid Sep 30, 2026</small></td><td>30 Staff</td><td><b>₱450,400.00</b></td><td><span class="badge green">Completed</span></td></tr>
            </tbody>
          </table>
        </div>

        <div class="card panel">
          <div class="panel-head">
            <div><h2>Pending Approvals</h2><p>Leave &amp; salary advance requests</p></div>
            <span class="count">4</span>
          </div>
          <div class="approval">
            <div class="ap-top"><span class="badge tag">Salary Advance</span><small>Today, 9:15 AM</small></div>
            <b>Bagus Fikri</b><p>Requested ₱5,000.00 • 2-cutoff deduction</p>
            <div class="ap-btns"><button class="btn primary sm">Approve</button><button class="btn sm">Decline</button></div>
          </div>
          <div class="approval">
            <div class="ap-top"><span class="badge amber">Sick Leave</span><small>Yesterday</small></div>
            <b>Mufti Hidayat</b><p>Nov 13 – Nov 14, 2026 (2 Days)</p>
            <div class="ap-btns"><button class="btn primary sm">Approve</button><button class="btn sm">Decline</button></div>
          </div>
          <div class="approval">
            <div class="ap-top"><span class="badge tag">Salary Loan</span><small>Nov 10, 2026</small></div>
            <b>Fauzan Ardhiansyah</b><p>Requested ₱12,000.00 • 6-month term</p>
            <div class="ap-btns"><button class="btn primary sm">Approve</button><button class="btn sm">Decline</button></div>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>
<script src="adminmenu.js"></script>
</body>
</html>