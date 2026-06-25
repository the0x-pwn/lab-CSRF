<div align="center">

<!-- Replace the image below with your own professional banner -->
![CSRF Lab Banner](https://via.placeholder.com/900x300/0d1117/00ff88?text=CSRF+Security+Lab)

# 🛡️ CSRF Security Lab

**Cross-Site Request Forgery — Practical Exploitation & Defense**

![Made by](https://img.shields.io/badge/Made%20by-ali%20waled-blueviolet?style=flat-square)
![Security](https://img.shields.io/badge/Category-Web%20Security-red?style=flat-square)
![Labs](https://img.shields.io/badge/Labs-3%2B-brightgreen?style=flat-square)
![Level](https://img.shields.io/badge/Level-Beginner%20to%20Advanced-orange?style=flat-square)

</div>

---

## 📌 Overview

**CSRF Security Lab** is a hands-on sandbox environment designed for security researchers, students, and penetration testers who want to understand and practice **Cross-Site Request Forgery (CSRF)** attacks in a **safe, controlled environment**.

The lab simulates real-world vulnerable web applications and guides you through multiple exploitation scenarios, ranging from basic token bypass to advanced attack chains.

> ⚡ **Each lab includes a built-in solution feature** — so if you get stuck, you can reveal the solution and understand the full attack context step by step.

---

## 🖼️ Lab Preview

<!-- Replace with your own screenshot -->
<div align="center">

![Lab Screenshot](https://via.placeholder.com/800x450/1a1a2e/00ff88?text=📸+Add+Your+Lab+Screenshot+Here)

*Screenshot: Lab interface with the CSRF Sandbox environment*

</div>

---

## 🔐 Credentials

All labs share the same login credentials:

| Field    | Value            |
|----------|------------------|
| 📧 Email | `csrf@lab.com`   |
| 🔑 Password | `csrf`        |

---

## 🧪 Labs

The lab includes **multiple exploitation scenarios** covering a wide variety of CSRF attack types and bypass techniques. More labs are continuously being added.

| Lab | Status |
|-----|--------|
| `lab-1` | ✅ Available |
| `lab-2` | ✅ Available |
| `lab-3` | ✅ Available |
| More... | 🔄 Coming Soon |

> 🔒 Each lab focuses on a different exploitation type — from simple unprotected endpoints to more sophisticated bypass methods.

---

## 🚀 How to Use

### 1. Login
Use the credentials above to log in to any lab.

### 2. Read the Lab Description
Each lab comes with:
- A description of the vulnerable functionality
- The goal of the attack
- Hints to guide you

### 3. Craft Your Exploit
Build your CSRF payload based on the lab scenario. Example structure:

```html
<!DOCTYPE html>
<html>
  <body>
    <form id="csrfForm" action="http://TARGET/vulnerable-endpoint" method="POST" style="display:none;">
      <input type="hidden" name="param" value="malicious-value">
    </form>
    <script>
      document.getElementById('csrfForm').submit();
    </script>
  </body>
</html>
```

### 4. Use the Built-in Solution
Stuck? Every lab has a **💡 Solution** button that reveals the full exploit and explains why it works — perfect for learning the attack context.

---

## 🎯 Learning Objectives

After completing the labs, you will be able to:

- Understand how CSRF vulnerabilities arise
- Identify missing or bypassable CSRF protections
- Craft working CSRF exploits for various scenarios
- Understand mitigation techniques (tokens, SameSite cookies, etc.)

---

## ⚠️ Disclaimer

> This lab is intended **for educational purposes only**.  
> All attacks must be performed **within this sandbox environment only**.  
> Unauthorized use against real systems is **illegal and unethical**.

---

## 👤 Author

<div align="center">

**ali waled**

*Security Researcher & Lab Creator*

</div>

---

<div align="center">

Made with ❤️ for the security community

</div>
