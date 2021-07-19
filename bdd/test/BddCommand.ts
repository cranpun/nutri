import { execSync } from "child_process";
// import sound from "sound-play";
const sound = require("sound-play");
import path = require("path");
import fs = require("fs");

export function env(key: string): string {
    if(process.env[key]) {
        return process.env[key]!;
    } else {
        return "(env error : process.env is null)";
    }
}
export async function wait(sec: number): Promise<void> {
    await Atomics.wait(new Int32Array(new SharedArrayBuffer(4)), 0, 0, sec);
}
export async function notifSuccess(mes: string): Promise<void> {
    console.info(mes);
    await sound.play(path.join(__dirname, "..", "file", "success.mp3"));
}

export async function notifError(mes: string): Promise<void> {
    console.error(mes);
    await sound.play(path.join(__dirname, "..", "file", "error.mp3"));
}

export async function notifStart(mes: string): Promise<void> {
    console.log(mes);
    await sound.play(path.join(__dirname, "..", "file", "start.mp3"));
}

export async function exportSql(filename: string, role: string): Promise<void> {
    console.log("           -> DB export：" + filename);
    const yml = path.join(__dirname, "..", "..", "docker", "docker-compose.yml");
    const cmd = `docker-compose -f ${yml} exec -T ${env("DKCONTAINER")} bash -c "mysqldump -u root homestead > /var/www/html/bdd/sql/${role}/${filename}.sql";`;
    await execSync(cmd);
    console.log("               -> DB export done");
}
export async function importSql(filename: string): Promise<void> {
    console.log("               <- DB import：" + filename);
    const yml = path.join(__dirname, "..", "..", "docker", "docker-compose.yml");
    await execSync(`docker-compose -f ${yml} exec -T ${env("DKCONTAINER")} bash -c "mysql -u root homestead < /var/www/html/bdd/sql/${filename}.sql";`);
    console.log("           <- DB import done");
}

export async function runSql(sql: string): Promise<void> {
    console.log("               <- run sql：" + sql);
    const yml = path.join(__dirname, "..", "..", "docker", "docker-compose.yml");
    await execSync(`docker-compose -f ${yml} exec -T ${env("DKCONTAINER")} mysql -u root homestead -e "${sql}"`);
    console.log("           <- run sql done");
}
export async function execCommand(command: string): Promise<void> {
    console.log("               <- exec command：" + command);
    const yml = path.join(__dirname, "..", "..", "docker", "docker-compose.yml");
    await execSync(`docker-compose -f ${yml} exec -T ${env("DKCONTAINER")} bash -c "${command};"`);
    console.log("           <- exec command done");
}

// 初期化。createdbとmigration等。init.shに書いてあるのでそれを実行。
export async function init(): Promise<void> {
    const yml = path.join(__dirname, "..", "..", "docker", "docker-compose.yml");
    await execSync(`docker-compose -f ${yml} exec -T ${env("DKCONTAINER")} bash -c "rm -f /var/www/html/bdd/log/*.jpg; /var/www/html/docker/os/init.sh";`);
}
export function datestr(date: Date): string {
    const y: string = date.getFullYear().toString();
    const m: string = `00${date.getMonth() + 1}`.slice(-2);
    const d: string = `00${date.getDate()}`.slice(-2);
    const ret: string = `${y}-${m}-${d}`;
    return ret;
}
