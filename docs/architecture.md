# Architecture

## Overview

GeniePanel menggunakan layered architecture.

Browser

↓

Laravel

↓

Controller

↓

Service

↓

Repository

↓

Database

---

## Services

History Layer

↓

Incident Layer

↓

Analytics Layer

↓

Customer Layer

---

## Database

MariaDB

↓

device_history

device_events

users

roles

permissions