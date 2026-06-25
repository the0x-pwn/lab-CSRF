<!-- SEO Meta (GitHub renders these as invisible comments, but crawlers index the text content below) -->
<!--
  CSRF Security Lab | Cross-Site Request Forgery | Web Security | Penetration Testing | PHP MVC | Tailwind CSS
  Author: ali waled | Educational Cybersecurity Lab | CSRF Exploit Practice | Web Application Security
-->

<div align="center">

<img src="img/banner.png" alt="CSRF Security Lab — Hands-on Web Security Training" width="100%"/>

<br/>
<br/>

# 🛡️ CSRF Security Lab

### Cross-Site Request Forgery — Practical Exploitation & Defense

<p>
  A hands-on security sandbox for learning, practicing, and mastering<br/>
  <strong>Cross-Site Request Forgery (CSRF)</strong> attacks in a safe, legal environment.
</p>

<br/>

[![Made by](https://img.shields.io/badge/Made%20by-ali%20waled-blueviolet?style=for-the-badge)](https://github.com/the0x)
[![Category](https://img.shields.io/badge/Category-Web%20Security-red?style=for-the-badge)](https://github.com/the0x)
[![Labs](https://img.shields.io/badge/Labs-3%2B-brightgreen?style=for-the-badge)](https://github.com/the0x)
[![Level](https://img.shields.io/badge/Level-Beginner%20to%20Advanced-orange?style=for-the-badge)](https://github.com/the0x)
[![Stack](https://img.shields.io/badge/Stack-PHP%20MVC%20%2B%20Tailwind%20CSS-0ea5e9?style=for-the-badge)](https://github.com/the0x)
[![License](https://img.shields.io/badge/License-Educational%20Use%20Only-yellow?style=for-the-badge)](https://github.com/the0x)

</div>

---

## 📖 Table of Contents

- [Overview](#-overview)
- [Tech Stack](#-tech-stack)
- [Labs](#-labs)
- [Credentials](#-credentials)
- [How to Use](#-how-to-use)
- [Learning Objectives](#-learning-objectives)
- [Disclaimer](#-disclaimer)
- [Author](#-author)

---

## 📌 Overview

**CSRF Security Lab** is an open-source, self-hosted web security training environment built for:

- 🎓 **Students** learning web application security fundamentals
- 🔍 **Penetration testers** sharpening their CSRF exploitation skills
- 🛠️ **Developers** understanding how CSRF vulnerabilities appear in real code

Each lab simulates a real-world vulnerable scenario, walking you through **multiple CSRF attack types and protection bypass techniques** — from the simplest missing-token cases to advanced attack chains.

> 💡 **Built-in Solutions** — Every lab ships with a reveal-on-demand solution so you can always understand the full attack context, even when you're stuck.

---

## 🛠️ Tech Stack

The entire lab environment was built from scratch using:

| Technology | Role |
|------------|------|
| **PHP (MVC Architecture)** | Backend — routing, controllers, models, session & token handling |
| **Tailwind CSS** | Frontend — responsive, dark-themed UI |
| **MySQL** | Database — user accounts, lab state, token storage |
| **HTML / Vanilla JS** | Exploit payloads & interactive lab UI |

> The MVC structure mirrors how real production applications are built — making the vulnerability demonstrations as realistic as possible.

---

## 🧪 Labs

> 🔒 Each lab targets a **different exploitation type** — ranging from completely unprotected endpoints to more sophisticated protection bypass methods. New labs are added continuously.

---

### 🔬 Lab 1

<div align="center">
<img src="img/lab-1.png" alt="CSRF Lab 1 — Screenshot" width="85%"/>
</div>

<br/>

| | |
|--|--|
| 📁 **Folder** | `lab-1` |
| 🎯 **Focus** | CSRF — Token Basic |
| ✅ **Status** | Available |
| 🔑 **Credentials** | `csrf@lab.com` / `csrf` |

---

### 🔬 Lab 2

<div align="center">
<img src="img/lab-2.png" alt="CSRF Lab 2 — Screenshot" width="85%"/>
</div>

<br/>

| | |
|--|--|
| 📁 **Folder** | `lab-2` |
| 🎯 **Focus** | CSRF Basic — GET Method Bypass |
| ✅ **Status** | Available |
| 🔑 **Credentials** | `csrf@lab.com` / `csrf` |

---

### 🔬 Lab 3

<div align="center">
<img src="img/lab-3.png" alt="CSRF Lab 3 — Screenshot" width="85%"/>
</div>

<br/>

| | |
|--|--|
| 📁 **Folder** | `lab-3` |
| 🎯 **Focus** | CSRF Bypass by Omitting the CSRF Token |
| ✅ **Status** | Available |
| 🔑 **Credentials** | `csrf@lab.com` / `csrf` |


---

## 🚀 How to Use

### Step 1 — Login
Navigate to the lab and sign in using the credentials above.

### Step 2 — Read the Objective
Each lab displays:
- The vulnerable feature being targeted
- Your goal as the attacker
- Optional hints to guide your approach

### Step 3 — Craft Your Exploit
Build a CSRF payload tailored to the lab's vulnerability. A typical base payload looks like:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CSRF PoC</title>
</head>
<body>
  <form id="csrfForm"
        action="http://TARGET/vulnerable-endpoint"
        method="POST"
        style="display:none;">
    <input type="hidden" name="param" value="malicious-value">
  </form>
  <script>
    document.getElementById('csrfForm').submit();
  </script>
</body>
</html>
```

> Each lab has a different target endpoint and parameters — adapt accordingly.

### Step 4 — Reveal the Solution
Stuck? Hit the **💡 Solution** button inside the lab to reveal the full working exploit and a detailed explanation of why the vulnerability exists and how the attack works.

---

## 🎯 Learning Objectives

After completing all labs, you will be able to:

- ✅ Explain what CSRF is and how it differs from XSS or SQLi
- ✅ Identify CSRF vulnerabilities in real PHP MVC applications
- ✅ Craft working exploits for various CSRF scenarios
- ✅ Bypass common (and flawed) CSRF protection implementations
- ✅ Understand and apply proper mitigations: tokens, `SameSite` cookies, `Origin` validation

---

## ⚠️ Disclaimer

> This project is intended **strictly for educational purposes**.
>
> All testing must be performed **only within this sandbox environment**.
>
> Performing CSRF attacks against real systems **without explicit written permission is illegal** and unethical.
>
> The author assumes **no responsibility** for any misuse of the content in this repository.

---

## 👤 Author

<div align="center">

<br/>

**ali waled**

*Security Researcher & Lab Creator*

<br/>

</div>

---

<div align="center">

⭐ If this lab helped you — consider giving it a star!

<br/>

*Made with ❤️ for the security community*

<br/>

**Keywords:** `CSRF` `Web Security` `Penetration Testing` `PHP MVC` `Tailwind CSS` `Ethical Hacking` `Bug Bounty` `Web Vulnerabilities` `CTF` `Security Lab`

</div>
