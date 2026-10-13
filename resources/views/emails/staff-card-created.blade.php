<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mi Profile Created</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:30px 15px;">
<tr>
<td align="center">

<table width="650" cellpadding="0" cellspacing="0"
style="max-width:650px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08);">

<tr>
<td align="center"
style="background:linear-gradient(135deg,#FC6C26,#e55a1a);padding:40px;color:#ffffff;">

<h1 style="margin:0;">Mi Profile</h1>
<p style="margin-top:10px;">Connect Beyond Contacts</p>

</td>
</tr>

<tr>
<td style="padding:40px;">

<h2 style="margin-top:0;color:#111827;">
🚀 Your Mi Profile Is Created
</h2>

<p>
Hi <strong>{{ $data['user_name'] }}</strong>,
</p>

<p>
Your Mi Profile is created successfully.
You’re now ready to build your digital identity, share your profile, and connect beyond contacts.
</p>

<div style="background:#fff7ed;padding:18px;border-radius:10px;border-left:4px solid #FC6C26;margin:25px 0;">
✅ No paper.<br>
✅ No repeated introductions.<br>
✅ No “send me your details again.”
</div>

<p>
Your Mi Profile is now live and ready to set up.
</p>

<h3 style="margin-top:35px;color:#FC6C26;">
Your Mi Profile Details
</h3>

<table width="100%" cellpadding="12" cellspacing="0"
style="border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">

<tr style="background:#f9fafb;">
<td width="35%"><strong>Name</strong></td>
<td>{{ $data['user_name'] }}</td>
</tr>

<tr>
<td><strong>Organization</strong></td>
<td>{{ $data['organization_name'] }}</td>
</tr>

<tr style="background:#f9fafb;">
<td><strong>Role / Designation</strong></td>
<td>{{ $data['designation'] }}</td>
</tr>

<tr>
<td><strong>Mi Profile Link</strong></td>
<td>
<a href="{{ $data['profile_link'] }}" style="color:#FC6C26;">
View Profile
</a>
</td>
</tr>

<tr style="background:#f9fafb;">
<td><strong>Login URL</strong></td>
<td>
<a href="{{ $data['login_url'] }}" style="color:#FC6C26;">
Login
</a>
</td>
</tr>

</table>

<div style="text-align:center;margin:35px 0;">
<a href="{{ $data['profile_link'] }}"
style="background:linear-gradient(135deg,#FC6C26,#e55a1a);color:#fff;text-decoration:none;padding:14px 30px;border-radius:50px;font-weight:bold;">
Open My Profile
</a>
</div>

<h3 style="color:#111827;">
What to do next
</h3>

<p>
<strong>01. Complete your profile</strong><br>
Add your photo, contact details, company information, services, social links, and business details.
</p>

<p>
<strong>02. Make it share-ready</strong><br>
Check your profile link, QR access, contact details, and meeting booking option.
</p>

<p>
<strong>03. Start sharing</strong><br>
Share your Mi Profile through WhatsApp, email, QR, social media, and business networking groups.
</p>

<div style="background:#fefce8;padding:20px;border-radius:12px;text-align:center;margin-top:30px;">
Your professional identity is now live.
</div>

</td>
</tr>

<tr>
<td align="center"
style="background:#111827;color:#ffffff;padding:25px;">

<strong>Team Mi Profile</strong><br>
Connect Beyond Contacts.

</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>