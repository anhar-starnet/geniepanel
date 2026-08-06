# History Engine

Flow

DeviceRepository

↓

HistoryComparator

↓

HistoryWriter

↓

device_history

---

HistoryComparator

Membandingkan snapshot lama dan snapshot baru.

Jika berubah:

↓

HistoryWriter

↓

Database

Jika tidak berubah:

↓

Ignore