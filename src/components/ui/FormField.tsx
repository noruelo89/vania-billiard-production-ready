import type React from "react";
import type { InputHTMLAttributes, SelectHTMLAttributes, TextareaHTMLAttributes } from "react";

type BaseProps = {
  label: string;
  name: string;
  hint?: string;
  error?: string;
};

type InputProps = BaseProps &
  InputHTMLAttributes<HTMLInputElement> & {
    kind?: "input";
  };

type TextareaProps = BaseProps &
  TextareaHTMLAttributes<HTMLTextAreaElement> & {
    kind: "textarea";
  };

type SelectProps = BaseProps &
  SelectHTMLAttributes<HTMLSelectElement> & {
    kind: "select";
    options: { label: string; value: string }[];
  };

type FormFieldProps = InputProps | TextareaProps | SelectProps;

const controlClasses =
  "w-full border border-border-subtle bg-surface px-4 py-3 text-sm text-text outline-none transition-colors placeholder:text-text-muted/70 focus:border-copper focus:ring-2 focus:ring-copper/30 disabled:cursor-not-allowed disabled:opacity-60";

export function FormField(props: FormFieldProps) {
  const describedBy = [props.hint ? `${props.name}-hint` : null, props.error ? `${props.name}-error` : null]
    .filter(Boolean)
    .join(" ");
  const shared = {
    id: props.name,
    "aria-invalid": Boolean(props.error),
    "aria-describedby": describedBy || undefined,
  };

  let control: React.ReactNode;

  if (props.kind === "textarea") {
    const { label: _label, hint: _hint, error: _error, kind: _kind, className, ...textareaProps } = props;
    control = <textarea {...textareaProps} {...shared} className={`${controlClasses} min-h-28 resize-y ${className ?? ""}`} />;
  } else if (props.kind === "select") {
    const { label: _label, hint: _hint, error: _error, kind: _kind, options, className, ...selectProps } = props;
    control = (
      <select {...selectProps} {...shared} className={`${controlClasses} ${className ?? ""}`}>
        {options.map((option) => (
          <option key={option.value} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
    );
  } else {
    const { label: _label, hint: _hint, error: _error, kind: _kind, className, ...inputProps } = props;
    control = <input {...inputProps} {...shared} className={`${controlClasses} ${className ?? ""}`} />;
  }

  return (
    <label className="block space-y-2" htmlFor={props.name}>
      <span className="text-sm font-semibold text-text">{props.label}</span>
      {control}
      {props.hint ? (
        <p id={`${props.name}-hint`} className="text-xs leading-relaxed text-text-muted">
          {props.hint}
        </p>
      ) : null}
      {props.error ? (
        <p id={`${props.name}-error`} className="text-xs font-semibold text-copper" role="alert">
          {props.error}
        </p>
      ) : null}
    </label>
  );
}
