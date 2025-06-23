import subprocess
import time
import webbrowser
import os
import signal
import shutil
import sys

DOCKER_COMPOSE_FILE = "docker-compose.yml"
LOCAL_URL = "http://127.0.0.1:8080"
SESSION_TIMEOUT = 60 * 60
BUNDLE_ROOT = os.path.dirname(os.path.abspath(__file__))

def start_docker():
    print("Starting Docker containers...")
    subprocess.run(["docker-compose", "up", "-d"], check = True)

def open_browser():
    print(f"Opening browser to {LOCAL_URL}")
    webbrowser.open(LOCAL_URL)

def stop_docker():
    print("Stopping Docker containers...")
    subprocess.run(["docker-compose", "down"], check=True)

def cleanup_files():
    print("Cleaning up downloaded logic bundle...")
    cleanup_targets = ["php-backends/uploads", "dist-frontend", "db"]

    for folder in cleanup_targets:
        full_path = os.path.join(BUNDLE_ROOT, folder)
        if os.path.exists(full_path):
            shutil.rmtree(full_path, ignore_errors=True)

def handle_exit(signum, frame):
    print("\nSession ended.")
    stop_docker()
    cleanup_files()
    sys.exit(0)

def wait_for_logout():
    print("Session running. Press control(⌃) + C to logout.")
    signal.signal(signal.SIGINT, handle_exit)
    signal.signal(signal.SIGTERM, handle_exit)

    try:
        time.sleep(SESSION_TIMEOUT)
    except KeyboardInterrupt:
        handle_exit(None, None)


if __name__ == "__main__":
    try:
        start_docker()
        time.sleep(5)
        open_browser()
        wait_for_logout()
    except subprocess.CalledProcessError as e:
        print(f"Error during Docker start: {e}")
        stop_docker()
        sys.exit(1)